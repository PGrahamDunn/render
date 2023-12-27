<?php

namespace App\Livewire\Menu;

use Livewire\Component;
use Illuminate\Support\Facades\Route;

class Admin extends Component
{
    public bool $menu_expanded = false;
    public string $menu_text = 'Administration';
    public array $menu_sub_texts = ['Users'];
    public array $menu_sub_links = ['users.index'];
    public int $menu_pill = 0;
    public array $menu_sub_pills = [0];
    public array $routes = ['users.index','users.create','users.edit'];

    public function mount()
    {
        $name = Route::currentRouteName();

        if (in_array($name, $this->routes))
        {
            $this->menu_expanded = true;
        }
    }

    public function menu_open()
    {
        $this->menu_expanded = !$this->menu_expanded;
    }

    public function render()
    {
        return view('livewire.menu.admin');
    }
}
