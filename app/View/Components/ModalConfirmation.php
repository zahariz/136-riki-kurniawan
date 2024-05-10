<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalConfirmation extends Component
{
    public $dataModalHide;
    public function __construct(
        $dataModalHide = ''
    )
    {
        $this->dataModalHide = $dataModalHide;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-confirmation');
    }
}
