<?php

namespace App\Acf\Fields;

use Extended\ACF\Fields\Select;

class Colors
{
    public static function make(string $label, string $id)
    {
        return Select::make($label, $id)->choices([
            'primary' => 'Couleur primaire',
            'secondary' => 'Couleur secondaire',
            'light'  => 'Blanc',
            'dark' => 'Noir',
        ])
            ->default('primary');
    }
}
