<?php

namespace QuantaForge\QuantaForgeIgnition\Http\Controllers;

use QuantaForge\Ignition\Config\IgnitionConfig;
use QuantaForge\QuantaForgeIgnition\Http\Requests\UpdateConfigRequest;

class UpdateConfigController
{
    public function __invoke(UpdateConfigRequest $request)
    {
        $result = (new IgnitionConfig())->saveValues($request->validated());

        return response()->json($result);
    }
}
