<?php

use QuantaQuirk\FlareClient\Flare;
use QuantaQuirk\FlareClient\Report;
use QuantaQuirk\Ignition\Config\IgnitionConfig;
use QuantaQuirk\Ignition\ErrorPage\ErrorPageViewModel;

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
