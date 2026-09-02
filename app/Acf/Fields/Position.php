<?php

namespace app\Acf\Fields;

use Extended\ACF\Fields\Select;

class Position
{
    public static function make(string $label, string $id)
    {
        return Select::make($label, $id)->choices([
            'left' => 'Gauche',
            'center' => 'Centre',
            'right' => 'Droite',
        ])
            ->default('left');
    }
}
