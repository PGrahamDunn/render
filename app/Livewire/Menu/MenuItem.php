<?php

namespace App\Livewire\Menu;

use Livewire\Component;

class MenuItem extends Component
{
    public int $menu_pill = 0;
    public string $menu_text = 'Temp';
    public string $menu_link = '#';
    
    public function render()
    {
        return view('livewire.menu.menu-item');
    }
}
