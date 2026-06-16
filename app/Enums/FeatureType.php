<?php

namespace App\Enums;

enum FeatureType: string
{
    case Component     = 'component';
    case Facade        = 'facade';
    case Artisan       = 'artisan';
    case Concept       = 'concept';
    case Configuration = 'configuration';
    case Helper        = 'helper';

    public function label(): string
    {
        return match($this) {
            self::Component     => 'Composant',
            self::Facade        => 'Facade',
            self::Artisan       => 'Artisan',
            self::Concept       => 'Concept',
            self::Configuration => 'Config',
            self::Helper        => 'Helper',
        };
    }
}
