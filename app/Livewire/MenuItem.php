<?php

namespace App\Livewire;

use Livewire\Component;

class MenuItem extends Component
{
    public string $menu_icon = '';
    public int $menu_pill = 0;
    public string $menu_text = '';
    public string $menu_link = '';
    
    public function render()
    {
        return view('livewire.menu-item');
    }
}
