@extends('layouts.app')

@section('title', 'Movie Catalog')

@section('content')
    <h1>Movie Catalog</h1>

    <div style="margin-bottom: 2rem; display: flex; gap: 1rem; flex-wrap: wrap; align-items: flex-end;">
        <!-- Search Form -->
        <form method="GET" action="{{ route('catalog.index') }}" style="flex: 1; min-width: 250px;">
            <div class="form-group" style="margin-bottom: 0;">
                <label for="search">Search by Title:</label>
                <div style="display: flex; gap: 0.5rem;">
                    <input type="text" id="search" name="search" placeholder="Enter movie title..." value="{{ $searchTitle }}" style="flex: 1;">
                    <button type="submit" class="btn" style="padding: 0.75rem 1rem;">Search</button>
                    @if ($searchTitle)
                        <a href="{{ route('catalog.index') }}" class="btn" style="background-color: #95a5a6; padding: 0.75rem 1rem;">Clear</a>
                    @endif
                </div>
            </div>
            <!-- Preserve genre filter when searching -->
            @if ($selectedGenre)
                <input type="hidden" name="genre" value="{{ $selectedGenre }}">
            @endif
        </form>

        <!-- Genre Filter -->
        <form method="GET" action="{{ route('catalog.index') }}" style="min-width: 250px;">
            <div class="form-group" style="margin-bottom: 0;">
                <label for="genre">Filter by Genre:</label>
                <div style="display: flex; gap: 0.5rem;">
                    <select id="genre" name="genre" onchange="this.form.submit()" style="flex: 1;">
                        <option value="">All Genres</option>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}" {{ $selectedGenre == $genre->id ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Preserve search when filtering by genre -->
            @if ($searchTitle)
                <input type="hidden" name="search" value="{{ $searchTitle }}">
            @endif
        </form>
    </div>

    @if ($movies->count())
        <div class="grid">
            @foreach ($movies as $movie)
                <div class="grid-item">
                    <a href="{{ route('catalog.show', $movie) }}">
                        @if ($movie->poster_url)
                            <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}">
                        @else
                            <div style="width: 100%; height: 350px; background-color: #ecf0f1; display: flex; align-items: center; justify-content: center; color: #95a5a6;">
                                No Image
                            </div>
                        @endif
                        <div class="grid-item-title">{{ $movie->title }}</div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="pagination">
            {{ $movies->links() }}
        </div>
    @else
        <p>
            @if ($searchTitle || $selectedGenre)
                No movies found matching your search criteria. Try adjusting your filters.
            @else
                No movies found. Check back later!
            @endif
        </p>
    @endif
@endsection

