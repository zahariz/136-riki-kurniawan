<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SideLinkGroup extends Component
{
    public $title;
    public $toggleName;
    public function __construct(
        $title = null,
        $toggleName = null
    )
    {
        $this->title = $title;
        $this->toggleName = $toggleName;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.side-link-group');
    }
}
