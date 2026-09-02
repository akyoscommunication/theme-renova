<?php

namespace App\Acf\Fields;

use Extended\ACF\Fields\Select;

class Alignement
{
    public static function make(string $label, string $id)
    {
        return Select::make($label, $id)->choices([
            'normal' => 'CONTENU | IMAGES',
            'reverse' => 'IMAGES | CONTENU',
        ])
            ->default('normal');
    }
}
