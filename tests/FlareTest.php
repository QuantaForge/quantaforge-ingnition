<?php

use QuantaForge\Support\Facades\Artisan;
use QuantaForge\Support\Facades\View;
use QuantaForge\FlareClient\Flare;
use QuantaForge\QuantaForgeIgnition\Tests\Mocks\FakeClient;

beforeEach(function () {
    Artisan::call('view:clear');

    app()['config']['logging.channels.flare'] = [
        'driver' => 'flare',
    ];

    config()->set('logging.channels.flare.driver', 'flare');
    config()->set('logging.default', 'flare');
    config()->set('flare.key', 'some-key');

    $this->fakeClient = new FakeClient();

    app()->singleton(Flare::class, fn () => new Flare($this->fakeClient));


    $this->useTime('2019-01-01 12:34:56');

    View::addLocation(__DIR__.'/stubs/views');
});

it('can manually report exceptions', function () {
    \QuantaForge\QuantaForgeIgnition\Facades\Flare::sendReportsImmediately();

    \QuantaForge\QuantaForgeIgnition\Facades\Flare::report(new Exception());

    $this->fakeClient->assertRequestsSent(1);
});
