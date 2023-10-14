<?php

namespace QuantaForge\QuantaForgeIgnition\ContextProviders;

use QuantaForge\Http\Request;
use Livewire\LivewireManager;
use QuantaForge\FlareClient\Context\ContextProvider;
use QuantaForge\FlareClient\Context\ContextProviderDetector;

class QuantaForgeContextProviderDetector implements ContextProviderDetector
{
    public function detectCurrentContext(): ContextProvider
    {
        if (app()->runningInConsole()) {
            return new QuantaForgeConsoleContextProvider($_SERVER['argv'] ?? []);
        }

        $request = app(Request::class);

        if ($this->isRunningLiveWire($request)) {
            return new QuantaForgeLivewireRequestContextProvider($request, app(LivewireManager::class));
        }

        return new QuantaForgeRequestContextProvider($request);
    }

    protected function isRunningLiveWire(Request $request): bool
    {
        return $request->hasHeader('x-livewire') && $request->hasHeader('referer');
    }
}
