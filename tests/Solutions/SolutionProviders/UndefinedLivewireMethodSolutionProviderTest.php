<?php

use Livewire\Exceptions\MethodNotFoundException;
use QuantaQuirk\QuantaQuirkIgnition\Solutions\SolutionProviders\UndefinedLivewireMethodSolutionProvider;
use QuantaQuirk\QuantaQuirkIgnition\Tests\stubs\Components\TestLivewireComponent;
use QuantaQuirk\QuantaQuirkIgnition\Tests\TestClasses\FakeLivewireManager;

it('can solve an unknown livewire method', function () {
    FakeLivewireManager::setUp()->addAlias('test-livewire-component', TestLivewireComponent::class);

    $exception = new MethodNotFoundException('chnge', 'test-livewire-component');

    $canSolve = app(UndefinedLivewireMethodSolutionProvider::class)->canSolve($exception);
    [$solution] = app(UndefinedLivewireMethodSolutionProvider::class)->getSolutions($exception);

    expect($canSolve)->toBeTrue();

    expect($solution->getSolutionTitle())->toBe('Possible typo `QuantaQuirk\QuantaQuirkIgnition\Tests\stubs\Components\TestLivewireComponent::chnge`');
    expect($solution->getSolutionDescription())->toBe('Did you mean `QuantaQuirk\QuantaQuirkIgnition\Tests\stubs\Components\TestLivewireComponent::change`?');
});
