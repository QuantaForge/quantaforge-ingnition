<?php

namespace QuantaQuirk\QuantaQuirkIgnition\Tests;

use QuantaQuirk\Foundation\Testing\Concerns\MakesHttpRequests;
use QuantaQuirk\Http\Request;
use QuantaQuirk\FlareClient\Glows\Glow;
use QuantaQuirk\FlareClient\Report;
use QuantaQuirk\QuantaQuirkIgnition\Facades\Flare;
use QuantaQuirk\QuantaQuirkIgnition\IgnitionServiceProvider;
use QuantaQuirk\QuantaQuirkIgnition\Tests\TestClasses\FakeTime;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use MakesHttpRequests;

    protected $fakeClient = null;

    protected function setUp(): void
    {
        ray()->newScreen($this->getName());

        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        config()->set('flare.key', 'dummy-key');

        return [IgnitionServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Flare' => Flare::class,
        ];
    }

    public function useTime(string $dateTime, string $format = 'Y-m-d H:i:s')
    {
        $fakeTime = new FakeTime($dateTime, $format);

        Report::useTime($fakeTime);
        Glow::useTime($fakeTime);
    }

    public function createRequest($method, $uri, $parameters = [], $cookies = [], $files = [], $server = [], $content = null): Request
    {
        $files = array_merge($files, $this->extractFilesFromDataArray($parameters));

        $symfonyRequest = SymfonyRequest::create(
            $this->prepareUrlForRequest($uri),
            $method,
            $parameters,
            $cookies,
            $files,
            array_replace($this->serverVariables, $server),
            $content
        );

        return Request::createFromBase($symfonyRequest);
    }
}
