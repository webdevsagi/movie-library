@extends('layouts.app')

@section('title', 'Edit Movie - ' . $movie->title)

@section('content')
    <h1>Edit Movie: {{ $movie->title }}</h1>

    <form action="{{ route('movies.update', $movie) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title *</label>
            <input type="text" id="title" name="title" value="{{ old('title', $movie->title) }}" required>
            @error('title')
                <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="release_date">Release Date</label>
            <input type="date" id="release_date" name="release_date" value="{{ old('release_date', $movie->release_date?->format('Y-m-d')) }}">
            @error('release_date')
                <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="poster_url">Poster URL</label>
            <input type="url" id="poster_url" name="poster_url" value="{{ old('poster_url', $movie->poster_url) }}" placeholder="https://example.com/poster.jpg">
            @error('poster_url')
                <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="director">Director</label>
            <input type="text" id="director" name="director" value="{{ old('director', $movie->director) }}">
            @error('director')
                <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="runtime_minutes">Runtime (minutes)</label>
            <input type="number" id="runtime_minutes" name="runtime_minutes" value="{{ old('runtime_minutes', $movie->runtime_minutes) }}">
            @error('runtime_minutes')
                <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="actors">Actors</label>
            <textarea id="actors" name="actors">{{ old('actors', $movie->actors) }}</textarea>
            @error('actors')
                <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-success">Update Movie</button>
            <a href="{{ route('movies.index') }}" class="btn" style="background-color: #95a5a6;">Cancel</a>
        </div>
    </form>
@endsection
