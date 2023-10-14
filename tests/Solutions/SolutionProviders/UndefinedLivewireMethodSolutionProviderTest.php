<?php

use Livewire\Exceptions\MethodNotFoundException;
use QuantaForge\QuantaForgeIgnition\Solutions\SolutionProviders\UndefinedLivewireMethodSolutionProvider;
use QuantaForge\QuantaForgeIgnition\Tests\stubs\Components\TestLivewireComponent;
use QuantaForge\QuantaForgeIgnition\Tests\TestClasses\FakeLivewireManager;

it('can solve an unknown livewire method', function () {
    FakeLivewireManager::setUp()->addAlias('test-livewire-component', TestLivewireComponent::class);

    $exception = new MethodNotFoundException('chnge', 'test-livewire-component');

    $canSolve = app(UndefinedLivewireMethodSolutionProvider::class)->canSolve($exception);
    [$solution] = app(UndefinedLivewireMethodSolutionProvider::class)->getSolutions($exception);

    expect($canSolve)->toBeTrue();

    expect($solution->getSolutionTitle())->toBe('Possible typo `QuantaForge\QuantaForgeIgnition\Tests\stubs\Components\TestLivewireComponent::chnge`');
    expect($solution->getSolutionDescription())->toBe('Did you mean `QuantaForge\QuantaForgeIgnition\Tests\stubs\Components\TestLivewireComponent::change`?');
});
