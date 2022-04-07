<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TableIndex extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $headers = [];
    public $actions = [];
    public $objectProps = [];
    public $objects = [];
    public $pages = false;
    public $target;
    public $searchBar = '';
    public function __construct($objectProps,$objects, $headers, $actions, $pages = false, $target = false, $searchBar = null)
    {
        $this->searchBar = $searchBar;
        $this->objects = $objects;
        $this->objectProps = $objectProps;
        $this->headers = $headers;
        $this->actions = $actions;
        $this->pages = $pages;
        $this->target = $target;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.table-index');
    }
}
