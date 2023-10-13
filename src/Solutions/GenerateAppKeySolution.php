<?php

namespace QuantaQuirk\QuantaQuirkIgnition\Solutions;

use QuantaQuirk\Support\Facades\Artisan;
use QuantaQuirk\Ignition\Contracts\RunnableSolution;

class GenerateAppKeySolution implements RunnableSolution
{
    public function getSolutionTitle(): string
    {
        return 'Your app key is missing';
    }

    public function getDocumentationLinks(): array
    {
        return [
            'QuantaQuirk installation' => 'https://quantaquirk.com/docs/master/installation#configuration',
        ];
    }

    public function getSolutionActionDescription(): string
    {
        return 'Generate your application encryption key using `php artisan key:generate`.';
    }

    public function getRunButtonText(): string
    {
        return 'Generate app key';
    }

    public function getSolutionDescription(): string
    {
        return '';
    }

    public function getRunParameters(): array
    {
        return [];
    }

    public function run(array $parameters = []): void
    {
        Artisan::call('key:generate');
    }
}
