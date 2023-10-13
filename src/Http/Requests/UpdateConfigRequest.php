<?php

namespace QuantaQuirk\QuantaQuirkIgnition\Http\Requests;

use QuantaQuirk\Foundation\Http\FormRequest;
use QuantaQuirk\Validation\Rule;

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
