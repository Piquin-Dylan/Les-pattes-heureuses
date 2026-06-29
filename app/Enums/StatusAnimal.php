<?php

namespace App\Enums;

enum StatusAnimal: string
{
    case ADOPTABLE = 'adoptable';

    case ADOPTED = 'adopted';
    case IN_CARE = 'in_care';
    case UNAVAILABLE = 'unavailable';
    case PENDING = 'pending';
    case IN_ADOPTION = 'in_adoption';

    public function label(): string
    {
        return match ($this) {
            self::ADOPTABLE => 'Adoptable',
            self::ADOPTED => 'Adopté',
            self::IN_CARE => 'Pris en charge',
            self::UNAVAILABLE => 'Indisponible',
            self::PENDING => 'En attente',
            self::IN_ADOPTION => "En cours d'adoption",
        };
    }
}


