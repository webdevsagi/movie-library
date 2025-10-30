<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'release_date', 'poster_url', 'director',
        'runtime_minutes', 'actors', 'imdb_id'
    ];

    protected $casts = [
        'release_date' => 'date',
        'runtime_minutes' => 'integer',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}
