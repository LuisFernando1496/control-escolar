<?php

namespace App\Http\Livewire\User;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Livewire\Component;

class UpdateComponent extends Component
{
    public User $user;
    function rules() {
        return [
            'user.name'=>'string|max:255',
            'user.lastname1'=>'string|max:255',
            'user.lastname2'=>'string|max:255',
            'user.rfc'=>'string|min:13|max:13|nullable',
            'user.key'=>'string|max:15',
            'user.phone'=>'min:10|numeric',
            'user.sex'=>'boolean',
            'user.birthday'=>'date',
            'user.active'=>'boolean',
        ];
    }
    public function render()
    {
        return view('livewire.user.update-component',['user'=>$this->user]);
    }
    public function save(){
        $this->validate(
            [
                'user.name'=>'string|max:255',
                'user.lastname1'=>'string|max:255',
                'user.lastname2'=>'string|max:255',
                'user.rfc'=>'string|min:13|max:13|nullable',
                'user.key'=>'string|max:15',
                'user.phone'=>'min:10|numeric|unique:users,phone,'.$this->user->id,
                'user.sex'=>'boolean',
                'user.birthday'=>'date',
                'user.active'=>'boolean',
            ]
        );
        $this->user->save();
        $this->emit('show-toast','Usuarios.','Cambios Guardados','success');
        return redirect()->route('users.index');
    }
}
