<?php

namespace App\Enums;

enum SpeciesAnimal: string
{
    case chat = 'chat';
    case chien = 'chien';


    public function label(): string
    {
        return match ($this) {
            self::chat => 'chat',
            self::chien => 'chien',

        };
    }
}


