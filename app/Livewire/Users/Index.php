<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $sortField;
    public $sortAsc = true;

    public function sortBy($field)
    {
        if ($this->sortField == $field)
        {
            $this->sortAsc = !$this->sortAsc;
        }
        else
        {
            $this->sortAsc =true;
        }
        $this->sortField = $field;
    }

    public function resetsearch()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        return view('livewire.users.index', [
//            'users' => User::where('name', 'like', '%'. $this->search . '%')->paginate(10),
//            'users' => User::where('name', 'like', '%'. $this->search . '%')->orwhere('email', 'like', '%'. $this->search . '%')->paginate(10),
            'users' => User::where('name', 'like', '%'. $this->search . '%')
            ->orwhere('email', 'like', '%'. $this->search . '%')
            ->when($this->sortField, function ($query)
            {
                $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
            }
            )
            ->paginate(10),
        ]);
    }
}
