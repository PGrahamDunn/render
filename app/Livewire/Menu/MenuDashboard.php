<?php

namespace App\Livewire\Menu;

use Livewire\Component;

class MenuDashboard extends Component
{
    public int $menu_pill = 0;
    public string $menu_text = 'Dashboard';
    public string $menu_link = 'dashboard';


    public function render()
    {
        return view('livewire.menu.menu-dashboard');
    }
}
