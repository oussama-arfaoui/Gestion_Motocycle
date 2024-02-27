<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class action_button extends Component
{
    public $text;
    public $action;
    /**
     * Create a new component instance.
     * @param  string  $text
     * @param  string  $action
     * @return void
     */
    public function __construct($text, $path = null)
    {
        $this->text = $text;
        $this->action = $action;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.action_button');
    }
}
