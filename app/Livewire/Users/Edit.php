<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;

class Edit extends Component
{
    public User $user;
    public $roles;

    public function render()
    {
        return view('livewire.users.edit');
    }
}
