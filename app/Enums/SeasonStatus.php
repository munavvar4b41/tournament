<?php

namespace App\Enums;

enum SeasonStatus: string
{
    case Draft = 'draft';
    case RegistrationOpen = 'registration_open';
    case RegistrationClosed = 'registration_closed';
    case Auction = 'auction';
    case InProgress = 'in_progress';
    case Completed = 'completed';

    public function label(): string
    {
        return match ($this) {
            self::Draft => 'Draft',
            self::RegistrationOpen => 'Registration Open',
            self::RegistrationClosed => 'Registration Closed',
            self::Auction => 'Auction',
            self::InProgress => 'In Progress',
            self::Completed => 'Completed',
        };
    }
}
