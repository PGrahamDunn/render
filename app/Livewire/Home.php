<?php

namespace App\Livewire;

use Livewire\Component;

class Home extends Component
{
    public $sku = 'C2PNL1068';
    public $source = 'faire';

    public function render()
    {
        return view('livewire.home');
    }
}
