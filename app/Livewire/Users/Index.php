<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
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

    public function update_users()
    {
        set_time_limit(120);
        $response = Http::get(config('app.pgd_users_api_endpoint'));
        $users = json_decode($response->body());
        foreach($users as $user)
        {
            $current_user = User::where('badge_id',$user->badge_id)->first();
            if($current_user)
            {
                $current_user->name = $user->name;
                $current_user->email = $user->email;
                $current_user->save();
            }
            else
            {
                User::Create([
                    'name' => $user->name,
                    'badge_id' => $user->badge_id,
                    'email' => $user->email,
                    'password' => bcrypt(strtolower(trim(Str::before($user->name, ' '))) . '_1'),
                ]);
            }
        }
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
