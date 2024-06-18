<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UtilityController extends Controller
{
    public function actuate()
    {
        dump('actuated.');
        $is_valid = false;
        $template = false;
        $sku = 'C2CST0307';
        if(!$template)
        {
            $response = Http::timeout(60)->withHeaders(['apiKey' => config('app.pulse_key')])->get(config('app.pulse_endpoint') . '/api/Templates/GetTemplateInfo/' . strtoupper($sku));
            $pulse_template = json_decode($response->body());
            if ($pulse_template) 
            {
                dd($pulse_template);
            }
        }
        else
        {
            dd('found');
            $is_valid = true;
        }
        return $is_valid;
    }
}
