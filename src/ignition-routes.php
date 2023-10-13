<?php

use QuantaQuirk\Support\Facades\Route;
use QuantaQuirk\QuantaQuirkIgnition\Http\Controllers\ExecuteSolutionController;
use QuantaQuirk\QuantaQuirkIgnition\Http\Controllers\HealthCheckController;
use QuantaQuirk\QuantaQuirkIgnition\Http\Controllers\UpdateConfigController;
use QuantaQuirk\QuantaQuirkIgnition\Http\Middleware\RunnableSolutionsEnabled;

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
