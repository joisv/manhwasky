<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Permission extends Component
{
    use LivewireAlert;
    
    public $searchInput = '';
    public $users;
    public $selectedRoles = [];
    
    public function setRole($index, $role, $user_id)
    {
        if (!auth()->user()->hasRole('admin')) {
           $this->alert('error', 'kamu tidak memiliki izin');
           return;
        }
        $this->selectedRoles[$index] = $role;
        $user = User::find($user_id);
        $user->syncRoles($this->selectedRoles[$index]);

        $this->alert('success', 'user role updated', [
            'position' => 'top-end',
            'timer' => 2000,
            'toast' => true
        ]);
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
