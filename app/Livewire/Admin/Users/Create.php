<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Create extends Component
{
    use LivewireAlert;
    
    public $name;
    public $email;
    public $password;
    
    public function save()
    {
        if (auth()->user()->hasRole('admin')) {
            $this->validate([
                'name' => 'required|string|min:3',
                'email' => 'required|string|email|unique:users,email',
                'password' => 'required|min:8'
            ]);
    
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password)
            ]);
    
            $this->alert('success', 'user created successfully');
            $this->dispatch('re-render');
            $this->reset(['name' => 'email', 'password']);
        } else {
            $this->alert('error', 'kamu tidak memiliki izin');
        }
    }
    
    public function render()
    {
        return view('livewire.admin.users.create');
    }
}
