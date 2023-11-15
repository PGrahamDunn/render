<?php

namespace App\Livewire\Menu;

use Livewire\Component;
use Illuminate\Support\Facades\Route;

class MenuSubItem extends Component
{

    public bool $menu_expanded = false;
    public string $menu_icon = '/icons/menu-flag.svg';
    public string $menu_expanded_icon = '/icons/chevron-down.svg';
    public string $menu_collapsed_icon = '/icons/chevron-up.svg';
    public array $menu_texts = [];
    public array $menu_links = [];
    public array $menu_pills = [];
    
    public function mount()
    {
        $name = Route::currentRouteName();
        if ( $name == 'users.index')
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
        return view('livewire.menu.menu-sub-item');
    }
}