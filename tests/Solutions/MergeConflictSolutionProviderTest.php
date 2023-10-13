<?php

use QuantaQuirk\Support\Facades\View;
use QuantaQuirk\Ignition\Solutions\SolutionProviders\MergeConflictSolutionProvider;
use QuantaQuirk\QuantaQuirkIgnition\Tests\stubs\Controllers\GitConflictController;

beforeEach(function () {
    View::addLocation(__DIR__.'/../stubs/views');
});

it('can solve merge conflict exception', function () {
    try {
        app(GitConflictController::class);
    } catch (ParseError $error) {
        $exception = $error;
    }
    $canSolve = app(MergeConflictSolutionProvider::class)->canSolve($exception);

    expect($canSolve)->toBeTrue();
});
