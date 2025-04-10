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
        print('Store method called');
        Log::info('Store method called', ['request' => $request->all()]);
        $validated = $request->validate([
            'url' => ['required', 'url'],
        ]);

        $video = $this->watchLaterService->getOrCreateVideo($validated['url']);

        if (!$video) {
            abort(422, 'Video could not be added to watch later list.');
        }
    }

    /**
     * Toggle watched status
     */
    public function toggleWatched(Request $request, $id): bool
    {
        return $this->watchLaterService->toggleWatched($id, !$request->has('unwatched'));
    }
}
