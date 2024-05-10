<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectInput extends Component
{
    public $type;
    public $name;
    public $label;
    public $for;
    public $id;
    public $message;

    public function __construct(
        $type= null,
        $name= null,
        $id= null,
        $for= null,
        $label= null,
        $message= null,
    )
    {
        $this->type = $type;
        $this->name = $name;
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
        return view('components.select-input');
    }
}
