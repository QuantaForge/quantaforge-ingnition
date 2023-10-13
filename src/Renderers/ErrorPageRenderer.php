<?php

namespace QuantaQuirk\QuantaQuirkIgnition\Renderers;

use QuantaQuirk\FlareClient\Flare;
use QuantaQuirk\Ignition\Config\IgnitionConfig;
use QuantaQuirk\Ignition\Contracts\SolutionProviderRepository;
use QuantaQuirk\Ignition\Ignition;
use QuantaQuirk\QuantaQuirkIgnition\ContextProviders\QuantaQuirkContextProviderDetector;
use QuantaQuirk\QuantaQuirkIgnition\Solutions\SolutionTransformers\QuantaQuirkSolutionTransformer;
use QuantaQuirk\QuantaQuirkIgnition\Support\QuantaQuirkDocumentationLinkFinder;
use Throwable;

class ErrorPageRenderer
{
    public function render(Throwable $throwable): void
    {
        $viteJsAutoRefresh = '';

        if (class_exists('QuantaQuirk\Foundation\Vite')) {
            $vite = app(\QuantaQuirk\Foundation\Vite::class);

            if (is_file($vite->hotFile())) {
                $viteJsAutoRefresh = $vite->__invoke([]);
            }
        }

        app(Ignition::class)
            ->resolveDocumentationLink(
                fn (Throwable $throwable) => (new QuantaQuirkDocumentationLinkFinder())->findLinkForThrowable($throwable)
            )
            ->setFlare(app(Flare::class))
            ->setConfig(app(IgnitionConfig::class))
            ->setSolutionProviderRepository(app(SolutionProviderRepository::class))
            ->setContextProviderDetector(new QuantaQuirkContextProviderDetector())
            ->setSolutionTransformerClass(QuantaQuirkSolutionTransformer::class)
            ->applicationPath(base_path())
            ->addCustomHtmlToHead($viteJsAutoRefresh)
            ->renderException($throwable);
    }
}
