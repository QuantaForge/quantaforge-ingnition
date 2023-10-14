<?php

namespace QuantaForge\QuantaForgeIgnition\Http\Requests;

use QuantaForge\Foundation\Http\FormRequest;
use QuantaForge\Validation\Rule;

class UpdateConfigRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'theme' => ['required',  Rule::in(['light', 'dark', 'auto'])],
            'editor' => ['required'],
            'hide_solutions' => ['required', 'boolean'],
        ];
    }
}
