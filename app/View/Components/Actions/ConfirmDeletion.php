<?php

namespace App\View\Components\Actions;

use Illuminate\View\Component;

class ConfirmDeletion extends Component
{
    public $dataToDelete;
    public $title;
    public $methodDelete;

    /**
     * - se espera la informacion de lo que se eliminara
     * - el titulo que toma este modal
     * - el metodo que ejecutar para eliminacion e.g. destroy
     * @param string $dataToDelete
     * @param string $title
     * @param string $methodDelete
     */
    public function __construct($dataToDelete, $title, $methodDelete)
    {
        $this->dataToDelete = $dataToDelete;
        $this->title = $title;
        $this->methodDelete = $methodDelete;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.actions.confirm-deletion');
    }

}
