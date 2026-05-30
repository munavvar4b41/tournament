<?php

namespace App\Http\Requests\Admin;

use App\Concerns\SeasonValidationRules;
use App\Models\Season;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSeasonRequest extends FormRequest
{
    use SeasonValidationRules;

    public function authorize(): bool
    {
        return $this->user()?->can('create', Season::class) ?? false;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return $this->seasonRules();
    }
}
