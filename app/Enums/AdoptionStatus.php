<?php

namespace App\Enums;

enum AdoptionStatus: string
{
    case Pending = 'pending';
    case InProgress = 'in_progress';
    case Completed = 'completed';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'En attente',
            self::InProgress => 'En cours',
            self::Completed => 'Réussie',
            self::Cancelled => 'Annulée',
        };
    }

}



