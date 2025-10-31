@extends('layouts.app')

@section('title', 'Add New Movie')

@section('content')
    <h1>Add New Movie</h1>

    <form action="{{ route('movies.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Title *</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required>
            @error('title')
                <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="release_date">Release Date</label>
            <input type="date" id="release_date" name="release_date" value="{{ old('release_date') }}">
            @error('release_date')
                <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="poster_url">Poster URL</label>
            <input type="url" id="poster_url" name="poster_url" value="{{ old('poster_url') }}" placeholder="https://example.com/poster.jpg">
            @error('poster_url')
                <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="director">Director</label>
            <input type="text" id="director" name="director" value="{{ old('director') }}">
            @error('director')
                <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="runtime_minutes">Runtime (minutes)</label>
            <input type="number" id="runtime_minutes" name="runtime_minutes" value="{{ old('runtime_minutes') }}">
            @error('runtime_minutes')
                <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="actors">Actors</label>
            <textarea id="actors" name="actors">{{ old('actors') }}</textarea>
            @error('actors')
                <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-success">Create Movie</button>
            <a href="{{ route('movies.index') }}" class="btn" style="background-color: #95a5a6;">Cancel</a>
        </div>
    </form>
@endsection
