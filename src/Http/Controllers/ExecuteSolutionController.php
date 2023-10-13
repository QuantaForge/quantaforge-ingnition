<?php

namespace QuantaQuirk\QuantaQuirkIgnition\Http\Controllers;

use QuantaQuirk\Foundation\Validation\ValidatesRequests;
use QuantaQuirk\Ignition\Contracts\SolutionProviderRepository;
use QuantaQuirk\QuantaQuirkIgnition\Exceptions\CannotExecuteSolutionForNonLocalIp;
use QuantaQuirk\QuantaQuirkIgnition\Http\Requests\ExecuteSolutionRequest;
use QuantaQuirk\QuantaQuirkIgnition\Support\RunnableSolutionsGuard;

class ExecuteSolutionController
{
    use ValidatesRequests;

    public function __invoke(
        ExecuteSolutionRequest $request,
        SolutionProviderRepository $solutionProviderRepository
    ) {
        $this
            ->ensureRunnableSolutionsEnabled()
            ->ensureLocalRequest();

        $solution = $request->getRunnableSolution();

        $solution->run($request->get('parameters', []));

        return response()->noContent();
    }

    public function ensureRunnableSolutionsEnabled(): self
    {
        // Should already be checked in middleware but we want to be 100% certain.
        abort_unless(RunnableSolutionsGuard::check(), 400);

        return $this;
    }

    public function ensureLocalRequest(): self
    {
        $ipIsPublic = filter_var(
            request()->ip(),
            FILTER_VALIDATE_IP,
            FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
        );

        if ($ipIsPublic) {
            throw CannotExecuteSolutionForNonLocalIp::make();
        }

        return $this;
    }
}
