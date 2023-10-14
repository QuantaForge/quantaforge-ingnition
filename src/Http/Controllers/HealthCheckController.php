<?php

namespace QuantaForge\QuantaForgeIgnition\Http\Controllers;

use QuantaForge\Support\Facades\Artisan;
use QuantaForge\Support\Str;

class HealthCheckController
{
    public function __invoke()
    {
        return [
            'can_execute_commands' => $this->canExecuteCommands(),
        ];
    }

    protected function canExecuteCommands(): bool
    {
        Artisan::call('help', ['--version']);

        $output = Artisan::output();

        return Str::contains($output, app()->version());
    }
}
