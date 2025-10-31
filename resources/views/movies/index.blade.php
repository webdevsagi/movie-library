@extends('layouts.app')

@section('title', 'Movies - Admin Panel')

@section('content')
    <h1>Movies Management</h1>
    <p>Manage your movie library</p>

    <div style="margin-bottom: 2rem; display: flex; gap: 1rem;">
        <a href="{{ route('movies.create') }}" class="btn btn-success">➕ Add New Movie</a>
        <a href="{{ route('movies.import.search') }}" class="btn">🔍 Import from OMDb</a>
    </div>

    @if ($movies->count())
        <table>
            <thead>
            <tr>
                <th>Title</th>
                <th>Director</th>
                <th>Release Date</th>
                <th>Runtime</th>
                <th>Genres</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($movies as $movie)
                <tr>
                    <td>{{ $movie->title }}</td>
                    <td>{{ $movie->director ?? 'N/A' }}</td>
                    <td>{{ $movie->release_date?->format('Y-m-d') ?? 'N/A' }}</td>
                    <td>{{ $movie->runtime_minutes ? $movie->runtime_minutes . ' min' : 'N/A' }}</td>
                    <td>
                        @forelse ($movie->genres as $genre)
                            <span style="background-color: #e8f4f8; padding: 0.25rem 0.5rem; border-radius: 3px; font-size: 0.9rem;">{{ $genre->name }}</span>
                        @empty
                            N/A
                        @endforelse
                    </td>
                    <td>
                        <a href="{{ route('movies.show', $movie) }}" class="btn" style="padding: 0.25rem 0.5rem; font-size: 0.9rem;">View</a>
                        <a href="{{ route('movies.edit', $movie) }}" class="btn" style="padding: 0.25rem 0.5rem; font-size: 0.9rem;">Edit</a>
                        <form action="{{ route('movies.destroy', $movie) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="padding: 0.25rem 0.5rem; font-size: 0.9rem;">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $movies->links() }}
        </div>
    @else
        <p>No movies found. <a href="{{ route('movies.create') }}">Add one now</a>!</p>
    @endif
@endsection
