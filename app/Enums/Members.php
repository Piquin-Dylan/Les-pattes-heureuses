<?php

namespace App\Enums;

enum Members: string
{
    case Admin = 'admin';
    case Volunteer = 'volontaire';

    public function label():string {
        return match ($this) {
            self::Admin => 'admin',
            self::Volunteer => 'volontaire'
        };
    }
}


