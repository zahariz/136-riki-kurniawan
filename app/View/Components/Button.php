<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public $type;
    public $class;
    public $id;
    public $placeholder;
    public $dataModalToggle;
    public $dataDrawerTarget;
    public $dataDrawerShow;
    public $dataDrawerPlacement;
    public $ariaControls;


    public function __construct(
        $type = null,
        $class = null,
        $placeholder = null,
        $dataModalToggle=null,
        $dataDrawerTarget=null,
        $dataDrawerShow=null,
        $dataDrawerPlacement=null,
        $ariaControls=null,
        $id = null
    )
    {
        $this->type = $type;
        $this->class = $class;
        $this->placeholder = $placeholder;
        $this->dataModalToggle = $dataModalToggle;
        $this->dataDrawerTarget = $dataDrawerTarget;
        $this->dataDrawerShow = $dataDrawerShow;
        $this->dataDrawerPlacement = $dataDrawerPlacement;
        $this->ariaControls = $ariaControls;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}
