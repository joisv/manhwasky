<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Permission extends Component
{
    public $searchInput = '';
    public $users;
    public $setUserRole = [];
    
    public function updatedSetUserRole()
    {
        dd($this->setUserRole);
    }
    
    public function getUsers()
    {
        return User::search('name', $this->searchInput)->latest('id')->get();    
    }

    public function getPermissionUser()
    {
        $rolesToSearch = ['admin', 'editor', 'demo'];

        $users = User::whereHas('roles', function ($query) use ($rolesToSearch) {
            $query->whereIn('name', $rolesToSearch);
        })->get();
        
        return $users;
    }

    public function setSelectedUser($id)
    {
        
    }
    
    public function updatedSearchInput()
    {
        if ($this->searchInput !== '') {
            $this->users = $this->getUsers();    
        } else {
            $this->users = [];
        }
    }
    
    public function render()
    {
        return view('livewire.admin.permission', [
            'inPermissionUser' => $this->getPermissionUser(),
            'roles' => Role::all()
        ]);
    }
}
