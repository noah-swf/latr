<?php

namespace App\Services\VideoProviders;

interface VideoProviderInterface
{
    /**
     * Check if this provider can handle the given URL
     */
    public function canHandle(string $url): bool;

    /**
     * Extract platform-specific ID from URL
     */
    public function getVideoId(string $url): ?string;

    /**
     * Fetch video metadata
     */
    public function fetchVideoData(string $url): array;

    /**
     * Get thumbnail URL
     */
    public function getThumbnailUrl(string $videoId): string;

    /**
     * Get platform name
     */
    public function getPlatformName(): string;
}
