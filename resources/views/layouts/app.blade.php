<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Movie Library')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }
        header {
            background-color: #2c3e50;
            color: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        header nav {
            display: flex;
            gap: 2rem;
            align-items: center;
        }
        header a {
            color: white;
            text-decoration: none;
            font-weight: 500;
        }
        header a:hover {
            color: #3498db;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 4px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }
        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
        }
        .btn:hover {
            background-color: #2980b9;
        }
        .btn-danger {
            background-color: #e74c3c;
        }
        .btn-danger:hover {
            background-color: #c0392b;
        }
        .btn-success {
            background-color: #27ae60;
        }
        .btn-success:hover {
            background-color: #229954;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #34495e;
            color: white;
        }
        tr:hover {
            background-color: #f9f9f9;
        }
        form {
            background-color: white;
            padding: 2rem;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            max-width: 600px;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="url"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            font-family: inherit;
        }
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="date"]:focus,
        input[type="url"]:focus,
        input[type="number"]:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        .form-actions {
            display: flex;
            gap: 1rem;
        }
        .pagination {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
            margin: 2rem 0;
        }
        .pagination a, .pagination span {
            padding: 0.5rem 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-decoration: none;
            color: #3498db;
        }
        .pagination a:hover {
            background-color: #f5f5f5;
        }
        .pagination .active {
            background-color: #3498db;
            color: white;
            border-color: #3498db;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }
        .grid-item {
            background-color: white;
            border-radius: 4px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .grid-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .grid-item img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            display: block;
        }
        .grid-item-title {
            padding: 1rem;
            font-weight: 500;
            text-align: center;
            min-height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .grid-item a {
            text-decoration: none;
            color: inherit;
        }
        .movie-details {
            background-color: white;
            padding: 2rem;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .movie-details h1 {
            margin-bottom: 1rem;
        }
        .movie-details img {
            max-width: 300px;
            height: auto;
            margin-bottom: 2rem;
            border-radius: 4px;
        }
        .movie-details p {
            margin-bottom: 1rem;
            line-height: 1.6;
        }
        .movie-details strong {
            color: #2c3e50;
        }
        .radio-group {
            display: flex;
            gap: 2rem;
            margin-bottom: 1rem;
        }
        .radio-group label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0;
        }
        .radio-group input[type="radio"] {
            width: auto;
        }
        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 2rem;
            margin-top: 4rem;
        }
    </style>
</head>
<body>
<header>
    <nav>
        <a href="{{ route('catalog.index') }}">🏠 Home</a>
        <a href="{{ route('movies.index') }}">📚 Admin Panel</a>
        <a href="{{ route('movies.create') }}">➕ Add Movie</a>
        <a href="{{ route('movies.import.search') }}">🔍 Import from OMDb</a>
    </nav>
</header>

<div class="container">
    @if ($message = session('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    @if ($message = session('error'))
        <div class="alert alert-error">
            {{ $message }}
        </div>
    @endif

    @if ($message = session('warning'))
        <div class="alert alert-warning">
            {{ $message }}
        </div>
    @endif

    @yield('content')
</div>

<footer>
    <p>&copy; 2025 Movie Library. Built with Laravel & OMDb API.</p>
</footer>
</body>
</html>
