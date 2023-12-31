<?php

use QuantaForge\FlareClient\Flare;
use QuantaForge\FlareClient\Report;
use QuantaForge\Ignition\Config\IgnitionConfig;
use QuantaForge\Ignition\ErrorPage\ErrorPageViewModel;

it('can encode invalid user data', function () {
    $flareClient = app()->make(Flare::class);

    $exception = new Exception('Test Exception');

    /** @var Report $report */
    $report = $flareClient->createReport($exception);

    $report->group('bad-utf8', [
        'name' => 'JohnDoe'.utf8_decode('ø'),
    ]);

    $model = new ErrorPageViewModel($exception, new IgnitionConfig([]), $report, []);

    $this->assertNotEmpty($model->jsonEncode($report->toArray()));
});
