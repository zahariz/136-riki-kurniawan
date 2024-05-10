<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BreadcumbLink extends Component
{
    public $current;
    public $route;
    public $title;
    public function __construct(
        $current = false,
        $title = null,
        $route = null
    )
    {
        $this->current = $current;
        $this->title = $title;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.breadcumb-link');
    }
}
