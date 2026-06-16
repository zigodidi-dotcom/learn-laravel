<?php

namespace App\Enums;

enum CodeLanguage: string
{
    case Php   = 'php';
    case Blade = 'blade';
    case Shell = 'shell';
    case Env   = 'env';
    case Json  = 'json';
}
