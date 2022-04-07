<?php

namespace App\Http\Livewire\AccessControl;

use Livewire\Component;
use App\Models\Role;
use App\Models\Permission;

class MainComponent extends Component
{
    //fuction to control modals 
    public $formModal, $privilegiosModal = false;
    public $view;

    // objeto o arrya que almacenara para mostrar
    public  $roles, $permissions, $rolePermission;
    public ?Role $role; // de esta forma se inicializa la variable con un objeto de tipo Role
    //permissions vairabels
    /**
     * variable temporal para 
     * saber si el usuario tiene o no 
     * acceso total
     * @var [access] int => 
     */
    public $access;

    protected $rules = [
        "role.name" => "required",
        "role.description" => "required",
        "role.full_access" => "required",
        "role.active" => "boolean",
    ];

    public function render()
    {
        $this->permissions = Permission::orderBy('slug', 'desc')->get();
        $this->roles = Role::all(); 
        return view('livewire.access-control.main-component',[
            "roles" => $this->roles
        ]);
    }

     /**
     *show the modal 
     * new mode
     * @param interger $id
     * @return void
     */
    public function showModalNew()
    {
        $this->clean(); //clean $role variable
        $this->view = "new";
        $this->formModal = true;
    }
    public function store()
    {
        $this->role->save();
        $this->formModal = false;
        $this->clean();
    }

    /**
     * method to show 
     * the modal 
     * edit mode
     * @param integer $id
     * @return void
     */
    public function showModalEdit(Role $role)
    {
        $this->view = "edit";
        $this->access = $role->full_access == "yes" ? 1 : 0 ; 
        $this->role = $role;
        $this->formModal = true;
    }

    public function update()
    {
        $this->role->full_access = $this->access == false ? 'no' : 'yes';
        $this->role->update();
        // $this->clean();
        $this->formModal = false;
    }

    //metodos para privilegios

    public function privilegiosShowModal(Role $role)
    {
        $this->role = $role;
        /**
         * Para solucionar el problema que no se cambiaba los valores
         * de un dato dentro del arreglo es tipo int, eje. [1,2]
         * pero por convencion de js lo quiere manejar de la forma ["1","2"]
         * de esta forma la data binding funciona si no cuando se trata
         * de un entero no lo interpreta o algo asi 
         * en lugar de usr each para esta collecion al usar map necesariamente retorne el valor
         * ya de esta manera la podemos alterar.
         */
        $this->rolePermission = $role->permissions()->pluck('permission_id')->map(function ($role) {
            return strval($role);
        });
        $this->privilegiosModal = true;
    
    }
    public function updatePerms()
    {
        // dd($this->rolePermission);
        $this->role->permissions()->sync($this->rolePermission);
        $this->privilegiosModal = false;
        // $this->clean();
    }


    /**
     * clean the actual public 
     * variable who handle the data
     *
     * @return void
     */
    public function clean()
    {
        $this->role = new Role;
        $this->rolePermission = null;
        $this->access = 0;
    }
}
