<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\WatchLaterVideo;
use App\Services\WatchLaterService;
use Illuminate\Support\Facades\Log;

class WatchLaterController extends Controller
{
    protected $watchLaterService;

    public function __construct(WatchLaterService $watchLaterService)
    {
        $this->watchLaterService = $watchLaterService;
    }

    /**
     * Display a listing of watch later videos, sorted by creation date (desc).
     */
    public function index(){
        $videos = WatchLaterVideo::orderBy('created_at', 'desc')->get();

        return view('watch-later.index', compact('videos'));
    }

    /**
     * Store a new watch later video
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'url' => ['required', 'url'],
        ]);

        $video = $this->watchLaterService->getOrCreateVideo($validated['url']);

        if (!$video) {
            abort(422, 'Video could not be added to watch later list.');
        }

         // HTML für das neue Video zurückgeben
        $html = view('components.watch-later-card', compact('video'))->render();

        return response()->json([
            'success' => true,
            'html' => $html
        ]);
    }

    public function destroy(Request $request)
    {
        $video = WatchLaterVideo::find($request->id);

        if ($video) {
            $video->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    /**
     * Toggle watched status
     */
    public function toggleWatched(Request $request, $id)
    {
        $result = $this->watchLaterService->toggleWatched($id, !$request->has('unwatched'));

        // Das Video nach dem Toggle neu laden für den HTML-Response
        $video = WatchLaterVideo::find($id);

        return response()->json([
            'success' => $result,
            'html' => $result ? view('components.watch-later-card', compact('video'))->render() : ''
        ]);
    }

    public function watched()
    {
        $videos = WatchLaterVideo::watched()->orderBy('created_at', 'desc')->get();
        return view('home', compact('videos'));
    }

    public function unwatched()
    {
        $videos = WatchLaterVideo::unwatched()->orderBy('created_at', 'desc')->get();
        return view('home', compact('videos'));
    }
}
