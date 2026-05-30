<?php

namespace App\Concerns;

use App\Enums\SeasonStatus;
use Illuminate\Validation\Rule;

trait SeasonValidationRules
{
    /**
     * @return array<string, mixed>
     */
    protected function seasonRules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'game_type' => ['required', 'string', 'max:255'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'registration_opens_at' => ['nullable', 'date'],
            'registration_closes_at' => ['nullable', 'date', 'after_or_equal:registration_opens_at'],
            'status' => ['required', Rule::enum(SeasonStatus::class)],
        ];
    }
}
