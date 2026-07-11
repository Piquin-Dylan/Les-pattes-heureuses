<?php

namespace App\Enums;

enum AdoptionStatus: string
{
    case Pending = 'en attente';
    case InProgress = 'en cours';
    case Completed = 'réussie';
    case Cancelled = 'annulée';

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



