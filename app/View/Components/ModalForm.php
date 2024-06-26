<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalForm extends Component
{
    public $id;
    public $dataModalHide;
    public $titleModal;
    public $action;
    public $method;
    public function __construct(
        $id = null,
        $dataModalHide = '',
        $titleModal = null,
        $action = null,
        $method = null
    )
    {
        $this->id = $id;
        $this->dataModalHide = $dataModalHide;
        $this->titleModal = $titleModal;
        $this->action = $action;
        $this->method = $method;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-form');
    }
}
