@extends('layouts.app')

@section('title', $movie->title)

@section('content')
    <div class="movie-details">
        <h1>{{ $movie->title }}</h1>

        @if ($movie->poster_url)
            <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}">
        @endif

        <p>
            <strong>Release Date:</strong>
            {{ $movie->release_date?->format('Y-m-d') ?? 'N/A' }}
        </p>

        <p>
            <strong>Director:</strong>
            {{ $movie->director ?? 'N/A' }}
        </p>

        <p>
            <strong>Runtime:</strong>
            {{ $movie->runtime_minutes ? $movie->runtime_minutes . ' minutes' : 'N/A' }}
        </p>

        <p>
            <strong>Actors:</strong>
            {{ $movie->actors ?? 'N/A' }}
        </p>

        <p>
            <strong>Genres:</strong>
            @forelse ($movie->genres as $genre)
                <span style="background-color: #e8f4f8; padding: 0.25rem 0.5rem; border-radius: 3px;">{{ $genre->name }}</span>
            @empty
                N/A
            @endforelse
        </p>

        @if ($movie->imdb_id)
            <p>
                <strong>IMDb:</strong>
                <a href="https://www.imdb.com/title/{{ $movie->imdb_id }}/" target="_blank" class="btn" style="padding: 0.25rem 0.5rem; font-size: 0.9rem;">View on IMDb</a>
            </p>
        @endif

        <div style="margin-top: 2rem;">
            <a href="{{ route('catalog.index') }}" class="btn" style="background-color: #95a5a6;">Back to Catalog</a>
        </div>
    </div>
@endsection
