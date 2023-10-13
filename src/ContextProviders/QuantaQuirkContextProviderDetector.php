<?php

namespace QuantaQuirk\QuantaQuirkIgnition\ContextProviders;

use QuantaQuirk\Http\Request;
use Livewire\LivewireManager;
use QuantaQuirk\FlareClient\Context\ContextProvider;
use QuantaQuirk\FlareClient\Context\ContextProviderDetector;

class QuantaQuirkContextProviderDetector implements ContextProviderDetector
{
    public function detectCurrentContext(): ContextProvider
    {
        if (app()->runningInConsole()) {
            return new QuantaQuirkConsoleContextProvider($_SERVER['argv'] ?? []);
        }

        $request = app(Request::class);

        if ($this->isRunningLiveWire($request)) {
            return new QuantaQuirkLivewireRequestContextProvider($request, app(LivewireManager::class));
        }

        return new QuantaQuirkRequestContextProvider($request);
    }

    protected function isRunningLiveWire(Request $request): bool
    {
        return $request->hasHeader('x-livewire') && $request->hasHeader('referer');
    }
}
