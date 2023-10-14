<?php

use QuantaForge\Auth\AuthenticationException;
use QuantaForge\QuantaForgeIgnition\Support\QuantaForgeDocumentationLinkFinder;
use QuantaForge\QuantaForgeIgnition\Support\QuantaForgeVersion;

beforeEach(function () {
    $this->finder = new QuantaForgeDocumentationLinkFinder();
});

it('can find a link for a quantaforge exception', function () {
    $link = $this->finder->findLinkForThrowable(new AuthenticationException());

    $majorVersion = QuantaForgeVersion::major();

    expect($link)->toEqual("https://quantaforge.com/docs/{$majorVersion}.x/authentication");
});
