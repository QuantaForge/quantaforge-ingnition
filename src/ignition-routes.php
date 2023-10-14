<?php

use QuantaForge\Support\Facades\Route;
use QuantaForge\QuantaForgeIgnition\Http\Controllers\ExecuteSolutionController;
use QuantaForge\QuantaForgeIgnition\Http\Controllers\HealthCheckController;
use QuantaForge\QuantaForgeIgnition\Http\Controllers\UpdateConfigController;
use QuantaForge\QuantaForgeIgnition\Http\Middleware\RunnableSolutionsEnabled;

Route::group([
    'as' => 'ignition.',
    'prefix' => config('ignition.housekeeping_endpoint_prefix'),
    'middleware' => [RunnableSolutionsEnabled::class],
], function () {
    Route::get('health-check', HealthCheckController::class)->name('healthCheck');

    Route::post('execute-solution', ExecuteSolutionController::class)
        ->name('executeSolution');

    Route::post('update-config', UpdateConfigController::class)->name('updateConfig');
});
