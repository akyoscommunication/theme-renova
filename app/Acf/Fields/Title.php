<?php

namespace App\Acf\Fields;

use Extended\ACF\Fields\ButtonGroup;
use Extended\ACF\Fields\Group;
use Extended\ACF\Fields\Text;
use Extended\ACF\Fields\Textarea;

class Title
{
    public static function make(string $label, string $id, $layout = 'table')
    {
        return Group::make($label, $id)->fields([
            Textarea::make('Valeur', 'value')
                ->rows(2)
                ->newLines('br'),
            ButtonGroup::make('Balise', 'tag')->choices([
                'h1' => 'H1',
                'h2' => 'H2',
                'h3' => 'H3',
                'h4' => 'H4',
                'h5' => 'H5',
                'p' => 'p',
            ]),
            Position::make('Position', 'position')
        ])->layout($layout);
    }
}
