<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SideLink extends Component
{
    public $href;
    public $title;
    public function __construct(
        $href = null,
        $title = null,
    )
    {
        $this->href = $href;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.side-link');
    }
}
