<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BreadcumbHead extends Component
{
    public $title;
    public $route;
    public function __construct(
        $title = null,
        $route = null
    )
    {
        $this->route = $route;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.breadcumb-head');
    }
}
