<?php

namespace App\Services\VideoProviders;

use Illuminate\Support\Facades\Http;

class YouTubeProvider implements VideoProviderInterface
{
    public function canHandle(string $url): bool
    {
        return preg_match(
            '%(?:youtube\.com|youtu\.be)%i',
            $url
        ) === 1;
    }

    public function getPlatformName(): string
    {
        return 'YouTube';
    }

    public function getVideoId(string $url): ?string
    {
        // Überprüfen, ob die URL von YouTube ist
        if(!$this->canHandle($url)) {
            return null;
        }

        preg_match(
            '%(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/|youtube\.com/shorts/)([^"&?/ ]{11})%i',
            $url,
            $matches
        );

        return $matches[1] ?? null;
    }

    public function fetchVideoData(string $url): array
    {
        // Überprüfen, ob die URL von YouTube ist
        if(!$this->canHandle($url)) {
            return [];
        }

        $videoId = $this->getVideoId($url);

        if (!$videoId) {
            return $this->getDefaultVideoData($url);
        }

        // Versuche, Daten über die API zu holen wenn ein API-Key konfiguriert ist
        $apiKey = config('services.youtube.key');

        if ($apiKey) {
            $apiUrl = "https://www.googleapis.com/youtube/v3/videos?part=snippet&id={$videoId}&key={$apiKey}";
            $response = Http::get($apiUrl);

            if ($response->successful() && isset($response['items'][0]['snippet'])) {
                $snippet = $response['items'][0]['snippet'];

                return [
                    'platform' => $this->getPlatformName(),
                    'video_id' => $videoId,
                    'title' => $snippet['title'] ?? null,
                    'thumbnail' => $snippet['thumbnails']['high']['url'] ?? $this->getThumbnailUrl($videoId),
                ];
            }
        }

        // Fallback ohne API
        return $this->getDefaultVideoData($url);
    }

    public function getThumbnailUrl(string $videoId): string
    {
        return "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg";
    }

    private function getDefaultVideoData(): array
    {
        return [
            'platform' => $this->getPlatformName(),
            'video_id' => null,
            'title' => "Unbekanntes YouTube-Video",
            'thumbnail' => 'https://img.youtube.com/vi/hqdefault.jpg',
        ];
    }
}
