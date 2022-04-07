<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class IndexComponent extends Component
{
    use WithPagination;
    public $search = '';
    public $perPage = '5';
    public $user;
    public $userFullname = '';
    protected $queryString = [
        'search' => ['except'=>''],
        'perPage' => ['except'=>0],
    ];
    public $confirmDeletion = false;
    public function render()
    {
        $totalUsers = User::all()->count();
        $this->page = $totalUsers >= $this->perPage ? $this->page : 1;
        return view('livewire.user.main-component',[
            'users'=>User::where('name','like', "%{$this->search}%")
            ->orWhere('email','like',"%{$this->search}%")
            ->orWhere('key','like',"%{$this->search}%")
            ->orderBy('name','desc')
            ->paginate($this->perPage)
        ]);
    }
    public function clear(){
        $this->search = '';
        $this->perPage = 5;
    }
    public function deleteConfirmationModal(User $user){
        $this->user = $user;
        $this->userFullname = $user->fullname();
        $this->confirmDeletion = true;
    }
    public function destroy(){
        $this->user->delete();
        $this->user = null;
        $this->confirmDeletion = false;
    }
    public function deleteCancel(){
        $this->confirmDeletion = false;
        $this->user = null;
    }
    public function edit(User $user){
        if(auth()->user()->findRole('admin') || auth()->user()->id == $user->id ){
            return redirect()->route('users.edit',$user);
        } else {
            $this->emit("show-toast", "Sistema", "No puedes realizar esta accion.", "danger");
        }
    }
}
