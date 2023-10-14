<?php

use QuantaForge\Support\Facades\View;
use QuantaForge\Support\Str;
use QuantaForge\QuantaForgeIgnition\Solutions\SolutionProviders\ViewNotFoundSolutionProvider;

beforeEach(function () {
    View::addLocation(__DIR__.'/../stubs/views');
});

it('can solve the exception', function () {
    $canSolve = app(ViewNotFoundSolutionProvider::class)->canSolve(getViewNotFoundException());

    expect($canSolve)->toBeTrue();
});

it('can recommend changing a typo in the view name', function () {
    /** @var \QuantaForge\Ignition\Contracts\Solution $solution */
    $solution = app(ViewNotFoundSolutionProvider::class)->getSolutions(getViewNotFoundException())[0];

    expect(Str::contains($solution->getSolutionDescription(), 'Did you mean `php-exception`?'))->toBeTrue();
});

it('wont recommend another controller class if the names are too different', function () {
    $unknownView = 'a-view-that-doesnt-exist-and-is-not-a-typo';

    /** @var \QuantaForge\Ignition\Contracts\Solution $solution */
    $solution = app(ViewNotFoundSolutionProvider::class)->getSolutions(getViewNotFoundException($unknownView))[0];

    expect(Str::contains($solution->getSolutionDescription(), 'Did you mean'))->toBeFalse();
});

// Helpers
function getViewNotFoundException(string $view = 'phpp-exceptionn'): InvalidArgumentException
{
    return new InvalidArgumentException("View [{$view}] not found.");
}
