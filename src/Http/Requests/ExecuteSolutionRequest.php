<?php

namespace QuantaForge\QuantaForgeIgnition\Http\Requests;

use QuantaForge\Foundation\Http\FormRequest;
use QuantaForge\Ignition\Contracts\RunnableSolution;
use QuantaForge\Ignition\Contracts\Solution;
use QuantaForge\Ignition\Contracts\SolutionProviderRepository;

class ExecuteSolutionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'solution' => 'required',
            'parameters' => 'array',
        ];
    }

    public function getSolution(): Solution
    {
        $solution = app(SolutionProviderRepository::class)
            ->getSolutionForClass($this->get('solution'));

        abort_if(is_null($solution), 404, 'Solution could not be found');

        return $solution;
    }

    public function getRunnableSolution(): RunnableSolution
    {
        $solution = $this->getSolution();

        if (! $solution instanceof RunnableSolution) {
            abort(404, 'Runnable solution could not be found');
        }

        return $solution;
    }
}
