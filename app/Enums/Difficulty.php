<?php

namespace App\Enums;

enum Difficulty: string
{
    case Beginner     = 'beginner';
    case Intermediate = 'intermediate';
    case Advanced     = 'advanced';

    public function label(): string
    {
        return match($this) {
            self::Beginner     => 'Débutant',
            self::Intermediate => 'Intermédiaire',
            self::Advanced     => 'Avancé',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::Beginner     => '#10b981',
            self::Intermediate => '#f59e0b',
            self::Advanced     => '#ef4444',
        };
    }
}
