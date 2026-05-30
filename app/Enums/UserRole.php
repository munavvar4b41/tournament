<?php

namespace App\Enums;

enum UserRole: string
{
    case SuperAdmin = 'super_admin';
    case Admin = 'admin';
    case TeamManager = 'team_manager';
    case Player = 'player';

    public function isSuperAdmin(): bool
    {
        return $this === self::SuperAdmin;
    }

    public function isAdmin(): bool
    {
        return $this === self::Admin;
    }

    public function canAccessAdmin(): bool
    {
        return in_array($this, [self::SuperAdmin, self::Admin], true);
    }

    public function label(): string
    {
        return match ($this) {
            self::SuperAdmin => 'Super Admin',
            self::Admin => 'Admin',
            self::TeamManager => 'Team Manager',
            self::Player => 'Player',
        };
    }
}
