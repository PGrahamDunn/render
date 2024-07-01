<?php

namespace App\Http\Controllers;

use App\Traits\PulseTemplates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UtilityController extends Controller
{
    use PulseTemplates;

    public function actuate()
    {   
        dump('actuated.');
    }

}
