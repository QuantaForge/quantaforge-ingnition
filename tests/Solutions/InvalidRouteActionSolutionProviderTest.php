<?php

use QuantaQuirk\Support\Facades\Route;
use QuantaQuirk\Support\Str;
use QuantaQuirk\QuantaQuirkIgnition\Solutions\SolutionProviders\InvalidRouteActionSolutionProvider;
use QuantaQuirk\QuantaQuirkIgnition\Support\Composer\ComposerClassMap;
use QuantaQuirk\QuantaQuirkIgnition\Tests\stubs\Controllers\TestTypoController;

beforeEach(function () {
    app()->bind(
        ComposerClassMap::class,
        function () {
            return new ComposerClassMap(__DIR__.'/../../vendor/autoload.php');
        }
    );
});

it('can solve the exception', function () {
    $canSolve = app(InvalidRouteActionSolutionProvider::class)->canSolve(getInvalidRouteActionException());

    expect($canSolve)->toBeTrue();
});

it('can recommend changing the routes method', function () {
    Route::get('/test', TestTypoController::class);

    /** @var \QuantaQuirk\Ignition\Contracts\Solution $solution */
    $solution = app(InvalidRouteActionSolutionProvider::class)->getSolutions(getInvalidRouteActionException())[0];

    expect(Str::contains($solution->getSolutionDescription(), 'Did you mean `TestTypoController`'))->toBeTrue();
});

it('wont recommend another controller class if the names are too different', function () {
    Route::get('/test', TestTypoController::class);

    $invalidController = 'UnrelatedTestTypoController';

    /** @var \QuantaQuirk\Ignition\Contracts\Solution $solution */
    $solution = app(InvalidRouteActionSolutionProvider::class)->getSolutions(getInvalidRouteActionException($invalidController))[0];

    expect(Str::contains($solution->getSolutionDescription(), 'Did you mean `TestTypoController`'))->toBeFalse();
});

// Helpers
function getInvalidRouteActionException(string $controller = 'TestTypooController'): UnexpectedValueException
{
    return new UnexpectedValueException("Invalid route action: [{$controller}]");
}
