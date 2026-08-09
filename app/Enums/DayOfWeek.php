<?php

namespace App\Enums;

enum DayOfWeek: string
{
    case Monday = 'lundi';
    case Tuesday = 'mardi';
    case Wednesday = 'mercredi';
    case Thursday = 'jeudi';
    case Friday = 'vendredi';
    case Saturday = 'samedi';
    case Sunday = 'dimanche';

    public function label(): string
    {
        return match ($this) {
            self::Monday => 'Lundi',
            self::Tuesday => 'Mardi',
            self::Wednesday => 'Mercredi',
            self::Thursday => 'Jeudi',
            self::Friday => 'Vendredi',
            self::Saturday => 'Samedi',
            self::Sunday => 'Dimanche',
        };
    }
}
