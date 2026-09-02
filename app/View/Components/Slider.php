<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Slider extends Component
{
    const string PREFIX = 'slider--';

    public $name;
    public $per;
    public $per_xs;
    public $per_sm;
    public $per_md;
    public array $modules;
    public array $extra;
    public bool $peekMobile;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $per, $perSm, $perMd, $perXs, $modules = [], $extra = [], $peekMobile = false)
    {

        $this->name = self::PREFIX.$name;
        $this->per = $per;
        $this->modules = $modules;
        $this->per_sm = $perSm;
        $this->per_md = $perMd;
        $this->per_xs = $perXs;
        $this->extra = $extra;
        $this->peekMobile = $peekMobile;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.slider');
    }
}
