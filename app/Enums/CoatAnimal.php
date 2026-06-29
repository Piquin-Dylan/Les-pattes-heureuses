<?php

namespace App\Enums;

enum CoatAnimal: string
{
    case SHORT_COAT = 'short_coat';
    case MEDIUM_COAT = 'medium_coat';
    case LONG_COAT = 'long_coat';
    case WIRE_COAT = 'wire_coat';
    case CURLY_COAT = 'curly_coat';
    case HAIRLESS = 'hairless';

    public function label(): string
    {
        return match ($this) {
            self::SHORT_COAT => 'Poils courts',
            self::MEDIUM_COAT => 'Poils mi-longs',
            self::LONG_COAT => 'Poils longs',
            self::WIRE_COAT => 'Poils durs',
            self::CURLY_COAT => 'Poils bouclés',
            self::HAIRLESS => 'Sans poils',
        };
    }
}
