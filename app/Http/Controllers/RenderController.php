<?php

namespace App\Http\Controllers;

use App\Traits\PulseTemplates;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class RenderController extends Controller
{
    use PulseTemplates;

    public function show_home(Request $request)
    {
        return view('home');
    }

    public function show_preview(Request $request)
    {
        // select
        // download
        // vendor
        // sku
        // log to table
        // dashboad
        // default screen
        // image manipulation
        
        $query_source = $request->query('source',null);
        $query_sku = strtoupper($request->query('sku', null));
        $request_ip = $request->ip();
        if (($query_sku) or (config('app.c2_preview_env') == 'local'))
        {
            $result = Visit::Create(['request_ip' => $request_ip, 'source' => $query_source, 'sku' => $query_sku]);
            return view('preview',['query_sku' => $query_sku, 'query_source' => $query_source]);
        }
        else
        {
            return redirect(route('home'));
        }        
    }

    public function show_map(Request $request)
    {
        return view('map');
    }

    public function show_old_map(Request $request)
    {
        return view('oldmap');
    }

    public function show_dashboard(Request $request)
    {
        $key = $request->input('dashboard_key', null);
        if ($key == 'ZDTXRVK')
        {
            return view('dashboard');
        }
        else
        {
            return redirect(Route('home'));
        }
    }

    public function verify_sku()
    {
        $this->verify_c2_template('C2VFR0343');
    }

}
