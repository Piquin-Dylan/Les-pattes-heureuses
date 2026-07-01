<?php

namespace App\Enums;

enum StatusAnimal: string
{
    case ADOPTABLE = 'Adoptable';

    case ADOPTED = 'Adopté';
    case IN_CARE = 'Pris en charge';
    case UNAVAILABLE = 'Indisponible';
    case PENDING = 'En attente';
    case IN_ADOPTION = 'En cours d adoption';

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


