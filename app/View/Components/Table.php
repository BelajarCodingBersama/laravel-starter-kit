<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public array $headers,
        public $items = [],
        public array $cells,
        public string $collspan,
        public array $actions = [],
        public ?string $routeEdit = null,
        public ?string $routeDelete = null,
        public ?string $routeUserAddRoles = null,
        public ?string $routeAddPermissions = null,
        public bool $pagination = false
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table');
    }
}
