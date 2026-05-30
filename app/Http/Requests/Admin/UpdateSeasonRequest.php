<?php

namespace App\Http\Requests\Admin;

use App\Concerns\SeasonValidationRules;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSeasonRequest extends FormRequest
{
    use SeasonValidationRules;

    public function authorize(): bool
    {
        return $this->user()?->can('update', $this->route('season')) ?? false;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return $this->seasonRules();
    }
}
