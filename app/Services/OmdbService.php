<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OmdbService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('app.omdb_api_url');
        $this->apiKey = config('app.omdb_api_key');
    }


    public function findMovie(string $query, bool $isImdbId = false): ?array
    {
        $params = [
            'apikey' => $this->apiKey,
            'plot' => 'full', // כדי לקבל יותר פרטים
            $isImdbId ? 'i' : 't' => $query,
        ];

        try {
            $response = Http::get($this->baseUrl, $params);
            $data = $response->json();

            if ($response->successful() && isset($data['Response']) && $data['Response'] === 'True') {
                return $data;
            }
        } catch (\Exception $e) {

            Log::error("OMDb API Error: " . $e->getMessage());
        }

        return null;
    }

    public function mapOmdbData(array $data): array
    {
        $safeGet = fn($key) => ($data[$key] ?? 'N/A') === 'N/A' ? null : ($data[$key] ?? null);

        $runtime = $safeGet('Runtime');
        $runtimeMinutes = null;
        if ($runtime && preg_match('/(\d+)\s*min/', $runtime, $matches)) {
            $runtimeMinutes = (int)$matches[1];
        }

        $releaseDate = $safeGet('Released');
        $formattedReleaseDate = null;
        if ($releaseDate && $releaseDate !== 'N/A') {
            try {

                $formattedReleaseDate = \Carbon\Carbon::createFromFormat('d M Y', $releaseDate)->format('Y-m-d');
            } catch (\Exception $e) {

            }
        }

        return [
            'title' => $safeGet('Title'),
            'release_date' => $formattedReleaseDate,
            'poster_url' => $safeGet('Poster'),
            'director' => $safeGet('Director'),
            'runtime_minutes' => $runtimeMinutes,
            'actors' => $safeGet('Actors'),
            'imdb_id' => $safeGet('imdbID'),
            'genres' => $safeGet('Genre'),
        ];
    }
}
