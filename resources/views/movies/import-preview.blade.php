@extends('layouts.app')

@section('title', 'Import Preview - ' . ($mappedData['title'] ?? 'Movie'))

@section('content')
    <h1>Import Preview</h1>
    <p>Review the movie details from OMDb before importing:</p>

    <form action="{{ route('movies.import.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Title *</label>
            <input type="text" id="title" name="title" value="{{ old('title', $mappedData['title'] ?? '') }}" required>
            @error('title')
                <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="release_date">Release Date</label>
            <input type="date" id="release_date" name="release_date" value="{{ old('release_date', $mappedData['release_date'] ?? '') }}">
            @error('release_date')
                <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="poster_url">Poster URL</label>
            <input type="url" id="poster_url" name="poster_url" value="{{ old('poster_url', $mappedData['poster_url'] ?? '') }}">
            @if ($mappedData['poster_url'] ?? null)
                <img src="{{ $mappedData['poster_url'] }}" alt="Poster" style="max-width: 200px; margin-top: 1rem; border-radius: 4px;">
            @endif
            @error('poster_url')
                <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="director">Director</label>
            <input type="text" id="director" name="director" value="{{ old('director', $mappedData['director'] ?? '') }}">
            @error('director')
                <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="runtime_minutes">Runtime (minutes)</label>
            <input type="number" id="runtime_minutes" name="runtime_minutes" value="{{ old('runtime_minutes', $mappedData['runtime_minutes'] ?? '') }}">
            @error('runtime_minutes')
                <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="actors">Actors</label>
            <textarea id="actors" name="actors">{{ old('actors', $mappedData['actors'] ?? '') }}</textarea>
            @error('actors')
                <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="genres">Genres</label>
            <input type="text" id="genres" name="genres" value="{{ old('genres', $mappedData['genres'] ?? '') }}" readonly style="background-color: #f5f5f5;">
            <small>Genres from OMDb (comma-separated)</small>
        </div>

        <input type="hidden" name="imdb_id" value="{{ $mappedData['imdb_id'] ?? '' }}">

        <div class="form-actions">
            <button type="submit" class="btn btn-success">Import Movie</button>
            <a href="{{ route('movies.import.search') }}" class="btn" style="background-color: #95a5a6;">Back</a>
        </div>
    </form>
@endsection
