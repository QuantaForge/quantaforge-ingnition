<?php

namespace QuantaForge\QuantaForgeIgnition\Renderers;

use QuantaForge\FlareClient\Flare;
use QuantaForge\Ignition\Config\IgnitionConfig;
use QuantaForge\Ignition\Contracts\SolutionProviderRepository;
use QuantaForge\Ignition\Ignition;
use QuantaForge\QuantaForgeIgnition\ContextProviders\QuantaForgeContextProviderDetector;
use QuantaForge\QuantaForgeIgnition\Solutions\SolutionTransformers\QuantaForgeSolutionTransformer;
use QuantaForge\QuantaForgeIgnition\Support\QuantaForgeDocumentationLinkFinder;
use Throwable;

class ErrorPageRenderer
{
    public function render(Throwable $throwable): void
    {
        $viteJsAutoRefresh = '';

        if (class_exists('QuantaForge\Foundation\Vite')) {
            $vite = app(\QuantaForge\Foundation\Vite::class);

            if (is_file($vite->hotFile())) {
                $viteJsAutoRefresh = $vite->__invoke([]);
            }
        }

        app(Ignition::class)
            ->resolveDocumentationLink(
                fn (Throwable $throwable) => (new QuantaForgeDocumentationLinkFinder())->findLinkForThrowable($throwable)
            )
            ->setFlare(app(Flare::class))
            ->setConfig(app(IgnitionConfig::class))
            ->setSolutionProviderRepository(app(SolutionProviderRepository::class))
            ->setContextProviderDetector(new QuantaForgeContextProviderDetector())
            ->setSolutionTransformerClass(QuantaForgeSolutionTransformer::class)
            ->applicationPath(base_path())
            ->addCustomHtmlToHead($viteJsAutoRefresh)
            ->renderException($throwable);
    }
}
