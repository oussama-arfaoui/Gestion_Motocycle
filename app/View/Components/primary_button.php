<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class primary_button extends Component
{

    public $text;
    public $path;
    /**
     * Create a new component instance.
     * @param  string  $text
     * @param  string  $path
     * @return void
     */
    public function __construct($text, $path = null)
    {
        $this->text = $text;
        $this->path = $path;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.primary_button');
    }
}
