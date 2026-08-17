<?php

namespace App\Enums;

enum MembershipRequestStatus: string
{
    case Pending = 'en attente';
    case Accepted = 'acceptée';
    case Rejected = 'refusée';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'En attente',
            self::Accepted => 'Acceptée',
            self::Rejected => 'Refusée',
        };
    }
}
