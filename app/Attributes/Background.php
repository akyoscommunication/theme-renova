<?php

namespace App\Attributes;

use Akyos\Core\Classes\Attribute;
use Akyos\Core\Classes\AttributeClass;

class Background extends AttributeClass
{
    protected function outputClass(): array
    {
        $res = [];

        if (isset($this->block['backgroundColor'])) {
            $res[0] = 'bg-color-'.$this->block['backgroundColor'];
        }

        return $res;
    }

    public function opt(): Attribute
    {
        return $this->attribute
            ->setAttributeOpt([
                'color' => [
                    "__experimentalDefaultControls" => [
                        "background" => true
                    ]
                ]
            ]);
    }
}
