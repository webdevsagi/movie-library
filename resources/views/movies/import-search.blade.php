@extends('layouts.app')

@section('title', 'Import from OMDb')

@section('content')
    <h1>Import Movie from OMDb</h1>
    <p>Search for a movie by title or IMDb ID to import it into your library.</p>

    <form action="{{ route('movies.import.find') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="query">Search Query *</label>
            <input type="text" id="query" name="query" placeholder="e.g., 'The Matrix' or 'tt0133093'" value="{{ old('query') }}" required>
            @error('query')
                <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Search By *</label>
            <div class="radio-group">
                <label>
                    <input type="radio" name="search_by" value="title" {{ old('search_by', 'title') === 'title' ? 'checked' : '' }}>
                    Movie Title
                </label>
                <label>
                    <input type="radio" name="search_by" value="imdb_id" {{ old('search_by') === 'imdb_id' ? 'checked' : '' }}>
                    IMDb ID (tt...)
                </label>
            </div>
            @error('search_by')
                <span style="color: #e74c3c; font-size: 0.9rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-success">Search OMDb</button>
            <a href="{{ route('movies.index') }}" class="btn" style="background-color: #95a5a6;">Cancel</a>
        </div>
    </form>
@endsection
