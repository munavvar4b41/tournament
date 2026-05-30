<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Season;
use App\Models\User;

class SeasonPolicy
{
    /**
     * @return bool|null
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole(UserRole::SuperAdmin) || $user->hasRole(UserRole::Admin);
    }

    public function view(User $user, Season $season): bool
    {
        return $user->hasRole(UserRole::SuperAdmin) || $user->hasRole(UserRole::Admin);
    }

    public function create(User $user): bool
    {
        return $user->hasRole(UserRole::SuperAdmin);
    }

    public function update(User $user, Season $season): bool
    {
        return $user->hasRole(UserRole::SuperAdmin);
    }

    public function delete(User $user, Season $season): bool
    {
        return $user->hasRole(UserRole::SuperAdmin);
    }
}
