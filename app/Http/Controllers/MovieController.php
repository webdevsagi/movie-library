<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use App\Services\OmdbService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MovieController extends Controller
{
    protected $omdbService;

    public function __construct(OmdbService $omdbService)
    {
        $this->omdbService = $omdbService;
    }

    public function index()
    {
        $movies = Movie::with('genres')->paginate(10);
        return view('movies.index', compact('movies'));
    }


    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'release_date' => 'nullable|date',
            'poster_url' => 'nullable|url',
            'director' => 'nullable|string|max:255',
            'runtime_minutes' => 'nullable|integer',
            'actors' => 'nullable|string',
        ]);

        Movie::create($validated);

        return redirect()->route('movies.index')->with('success', 'Movie created successfully.');
    }


    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }


    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'release_date' => 'nullable|date',
            'poster_url' => 'nullable|url',
            'director' => 'nullable|string|max:255',
            'runtime_minutes' => 'nullable|integer',
            'actors' => 'nullable|string',
        ]);

        $movie->update($validated);

        return redirect()->route('movies.index')->with('success', 'Movie updated successfully.');
    }


    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully.');
    }

    public function importSearch()
    {
        return view('movies.import-search');
    }


    public function importFind(Request $request)
    {
        $request->validate([
            'query' => 'required|string',
            'search_by' => 'required|in:title,imdb_id',
        ]);

        $isImdbId = $request->search_by === 'imdb_id';
        $omdbData = $this->omdbService->findMovie($request->input('query'), $isImdbId);

        if (!$omdbData) {
            return back()->with('error', 'Movie not found in OMDb or an error occurred. Try again.');
        }

        $mappedData = $this->omdbService->mapOmdbData($omdbData);

        if (Movie::where('imdb_id', $mappedData['imdb_id'])->exists()) {
            return back()->with('warning', 'This movie already exists in the library.');
        }

        return view('movies.import-preview', compact('mappedData'));
    }

    public function importStore(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'release_date' => 'nullable|date',
            'poster_url' => 'nullable|url',
            'director' => 'nullable|string|max:255',
            'runtime_minutes' => 'nullable|integer',
            'actors' => 'nullable|string',
            'imdb_id' => 'required|string|unique:movies,imdb_id',
            'genres' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $movie = Movie::create([
                'title' => $validatedData['title'],
                'release_date' => $validatedData['release_date'],
                'poster_url' => $validatedData['poster_url'],
                'director' => $validatedData['director'],
                'runtime_minutes' => $validatedData['runtime_minutes'],
                'actors' => $validatedData['actors'],
                'imdb_id' => $validatedData['imdb_id'],
            ]);

            if (!empty($validatedData['genres'])) {
                $genreNames = array_map('trim', explode(',', $validatedData['genres']));
                $genreIds = [];

                foreach ($genreNames as $genreName) {
                    if (empty($genreName)) continue;

                    $genre = Genre::firstOrCreate(['name' => $genreName]);
                    $genreIds[] = $genre->id;
                }

                $movie->genres()->sync($genreIds);
            }

            DB::commit();

            return redirect()->route('movies.index')->with('success', 'Movie imported successfully from OMDb!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Import failed: " . $e->getMessage());
            return back()->with('error', 'Error importing movie. Please try again.');
        }
    }
}
