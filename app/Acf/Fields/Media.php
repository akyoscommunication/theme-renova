<?php

namespace App\Acf\Fields;

use Extended\ACF\ConditionalLogic;
use Extended\ACF\Fields\Group;
use Extended\ACF\Fields\Image;
use Extended\ACF\Fields\Oembed;
use Extended\ACF\Fields\Select;

class Media
{
    public static function make(string $label, string $id)
    {
        return
            Group::make($label, $id)
                ->fields([
                    Select::make('Type', 'type')
                        ->choices([
                            'image' => 'Image',
                            'video' => 'Vidéo',
                        ]),
                    Image::make('Image', 'image')
                        ->conditionalLogic([
                            ConditionalLogic::where('type', '==', 'image')
                        ]),
                    Oembed::make('Vidéo', 'video')
                        ->conditionalLogic([
                            ConditionalLogic::where('type', '==', 'video')
                        ])
                ]);
    }
}
