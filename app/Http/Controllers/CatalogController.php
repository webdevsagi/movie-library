<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Display the public movie catalog with genre filtering, title search, and pagination.
     */
    public function index(Request $request)
    {
        $genres = Genre::all();
        $selectedGenre = $request->query('genre');
        $searchTitle = $request->query('search');

        $movies = Movie::query()
            ->when($selectedGenre, function ($query, $genreId) {
                return $query->whereHas('genres', function ($q) use ($genreId) {
                    $q->where('genre_id', $genreId);
                });
            })
            ->when($searchTitle, function ($query, $title) {
                return $query->where('title', 'like', '%' . $title . '%');
            })
            ->orderBy('release_date', 'desc')
            ->paginate(12);

        return view('catalog.index', compact('movies', 'genres', 'selectedGenre', 'searchTitle'));
    }

    /**
     * Display the details page for a specific movie.
     */
    public function show(Movie $movie)
    {
        return view('catalog.show', compact('movie'));
    }
}
