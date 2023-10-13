<?php

use QuantaQuirk\Auth\AuthenticationException;
use QuantaQuirk\QuantaQuirkIgnition\Support\QuantaQuirkDocumentationLinkFinder;
use QuantaQuirk\QuantaQuirkIgnition\Support\QuantaQuirkVersion;

beforeEach(function () {
    $this->finder = new QuantaQuirkDocumentationLinkFinder();
});

it('can find a link for a quantaquirk exception', function () {
    $link = $this->finder->findLinkForThrowable(new AuthenticationException());

    $majorVersion = QuantaQuirkVersion::major();

    expect($link)->toEqual("https://quantaquirk.com/docs/{$majorVersion}.x/authentication");
});
