<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PreviewController extends Controller
{
    public function show_home()
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

        
        $query_select = $request->boolean('select');
        $query_download = $request->boolean('download');
        $query_vendor = $request->query('vendor',null);
        $query_sku = strtoupper($request->query('sku', null));
        $request_host = $request->schemeAndHttpHost();
        return view('preview',['query_sku' => $query_sku, 'query_select' => $query_select, 'query_download' => $query_download, 'query_vendor' => $query_vendor, 'request_host' => $request_host]);
        
    }

    public function show_map()
    {
        /*
        // 1) get map
        // 2) convert to RGB?
        // 3) Add wood background for certain templates
        // 4) resizing

        $username = 'tonycmf';
        $access_token = 'pk.eyJ1IjoidG9ueWNtZiIsImEiOiJjbGdvMnAwNDkwbGxvM3RsdTFlajJkbWN2In0.P2934jiPU233bNahCAeS_w';

        $template = 'C2COA2046';
        //$coordinates = '12.09,32.186990,-80.748317';
        $coordinates = '9.34,48.1405,-116.5156';
        
        $coordinates_array = explode(',',$coordinates);

        $Blue = ["C2COA2046","C2HFA0056","C2BFW0001","C2BFW0002"];
        $Teal = ["C2BFW0009","C2BFW0011","C2HFA0063","C2COA2095"];
        $Grey = ["C2BFW0008","C2BFW0010","C2BFW0012","C2HFA0062","C2BFW0007","C2COA2094"];
        
        if (in_array($template, $Blue))
        {
            $style = "clgnvdcc7006801qgcuyy8vf0";
            $Map = true;
        }
        if (in_array($template, $Teal))
        {
            $style = "clmq4wp6304z301qxers706cf";
            $Map = false;
        }
        if (in_array($template, $Grey))
        {
            $style = "clmq4z7b604vy01p99ywdgc1z";
            $Map = false;
        }

        $zoom_054 = ["C2BFW0012", "C2BFW0008"];
        if (in_array($template,$zoom_054))
        {
            $coordinates_array[0] = $coordinates_array[0] - 0.54;
        }
        if ($template == "C2BFW0007")
        {
            $coordinates_array[0] = $coordinates_array[0] - 0.47;
        }
        if ($template == "C2BFW0010")
        {
            $coordinates_array[0] = $coordinates_array[0] - 0.57;
        }
        if ($template == "C2HFA0062")
        {
            $coordinates_array[0] = $coordinates_array[0] - 0.18;
        }
        $height = '1280';
        $width = '1280';
        $map_box_url = "https://api.mapbox.com/styles/v1/$username/$style/static/$coordinates_array[2],$coordinates_array[1],$coordinates_array[0],0/$height" . "x" . "$width@2x?logo=false&attribution=false&access_token=$access_token";
        $response_mapbox = Http::get($map_box_url);
        Storage::disk('local')->put("/public/mapbox-$style.png", $response_mapbox->body());
        dd('done - mapbox');
*/
        return view('map');
    }

    public function show_old_map()
    {
        return view('oldmap');
    }

    public function show_dashboard()
    {
        return view('dashboard');
    }
}
