<?php

namespace App\Services;

use App\Services\VideoProviders\VideoProviderInterface;
use Illuminate\Support\Collection;

class VideoProviderFactory
{
    /**
     * @var Collection<VideoProviderInterface>
     */
    protected $providers;

    public function __construct()
    {
        $this->providers = collect([]);
    }

    /**
     * Register a video provider
     */
    public function registerProvider(VideoProviderInterface $provider): self
    {
        $this->providers->push($provider);
        return $this;
    }

    /**
     * Find provider that can handle the given URL
     */
    public function getProviderForUrl(string $url): ?VideoProviderInterface
    {
        return $this->providers->first(function (VideoProviderInterface $provider) use ($url) {
            return $provider->canHandle($url);
        });
    }
}
