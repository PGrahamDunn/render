<?php

namespace App\Livewire\Menu;

use Livewire\Component;
use Livewire\Attributes\Session;

class Admin extends Component
{
    #[Session]
    public bool $menu_expanded = false;
    public string $menu_text = 'Administration';
    public array $menu_sub_texts = ['Users'];
    public array $menu_sub_links = ['users.index'];
    public int $menu_pill = 0;
    public array $menu_sub_pills = [0];

    public function menu_open()
    {
        $this->menu_expanded = !$this->menu_expanded;
    }

    public function render()
    {
        return view('livewire.menu.admin');
    }
}
