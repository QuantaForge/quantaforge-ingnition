<?php

namespace QuantaQuirk\QuantaQuirkIgnition\Http\Controllers;

use QuantaQuirk\Ignition\Config\IgnitionConfig;
use QuantaQuirk\QuantaQuirkIgnition\Http\Requests\UpdateConfigRequest;

class UpdateConfigController
{
    public function __invoke(UpdateConfigRequest $request)
    {
        $result = (new IgnitionConfig())->saveValues($request->validated());

        return response()->json($result);
    }
}
