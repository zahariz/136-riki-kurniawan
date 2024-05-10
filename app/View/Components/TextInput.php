<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextInput extends Component
{
    public $name;
    public $type;
    public $placeholder;
    public $id;
    public $for;
    public $label;
    public $message;

    public function __construct(
        $name = '',
        $type = '',
        $placeholder = '',
        $id = '',
        $for = null,
        $label = null,
        $message = null
    )
    {
        $this->name = $name;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->id = $id;
        $this->for = $for;
        $this->label = $label;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.text-input');
    }
}
