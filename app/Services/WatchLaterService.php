<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\WatchLaterVideo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class WatchLaterService
{
    protected $providerFactory;

    public function __construct(VideoProviderFactory $providerFactory)
    {
        $this->providerFactory = $providerFactory;
    }

    /**
     * Erstelle ein neues Video oder finde ein bestehendes
     *
     * @param string $url
     * @return WatchLaterVideo|null
     */
    public function getOrCreateVideo(string $url): ?WatchLaterVideo
    {
        // Finde den passenden Provider für die URL
        $provider = $this->providerFactory->getProviderForUrl($url);

        // Wenn kein Provider gefunden wurde, logge eine Warnung und gib null zurück
        if (!$provider) {
            Log::warning("No provider found for URL: {$url}");
            return null;
        }

        $videoId = $provider->getVideoId($url);
        $userId = Auth::id();

        // Wenn keine Video-ID gefunden wurde, logge eine Warnung und gib null zurück
        if (!$videoId) {
            Log::warning("Could not extract platform ID from URL: {$url}");
            return null;
        }

        // Suche nach existierendem Video in der Datenbank
        $video = WatchLaterVideo::where('platform', $provider->getPlatformName())
            ->where('video_id', $videoId)->where('user_id', $userId)
            ->first();

        // Wenn das Video bereits existiert, gib es zurück
        if ($video) {
            return $video;
        }

        // Daten vom Video abrufen
        $videoData = $provider->fetchVideoData($url);

        // Neues Video erstellen
        return WatchLaterVideo::create([
            'platform' => $videoData['platform'],
            'video_id' => $videoData['video_id'],
            'url' => $url,
            'title' => $videoData['title'],
            'thumbnail' => $videoData['thumbnail'],
            'user_id' => $userId,
        ]);
    }

    /**
     * Markiere ein Video als "gesehen" oder "ungesehen"
     *
     * @param int $id
     * @return bool
     */
    public function toggleWatched(Request $request, int $id): bool
    {
        // $video = $request->user()->watchLaterVideos()->findOrFail($id);
        $video = WatchLaterVideo::where('id', $id)->where('user_id', Auth::id())->first();
        if (!$video) {
            Log::error("Video with ID {$id} not found for user ID " . Auth::id());
            return false;
        }
        Log::debug("message");
        $video->watched = !($video->watched);
        return $video->save();
    }
}
