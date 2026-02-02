<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Table extends Component
{
    public string $title;
    public array $columns;
    public $filters;
    public $action;

    public function __construct(
        string $title,
        array $columns,
        $filters = null,
        $action = null
    ) {
        $this->title = $title;
        $this->columns = $columns;
        $this->filters = $filters;
        $this->action = $action;
    }

    public function render()
    {
        return view('components.table');
    }
}
