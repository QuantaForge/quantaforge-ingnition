<?php

use QuantaForge\Support\Facades\View;
use QuantaForge\Ignition\Solutions\SolutionProviders\MergeConflictSolutionProvider;
use QuantaForge\QuantaForgeIgnition\Tests\stubs\Controllers\GitConflictController;

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
