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
$this->verify_c2_template('C2CST0307');
$this->verify_c2_template('C2CST0309');
$this->verify_c2_template('C2CST0302');
$this->verify_c2_template('C2CST0312');
$this->verify_c2_template('C2CST0303');
$this->verify_c2_template('C2CST0299');
$this->verify_c2_template('C2CST0297');
$this->verify_c2_template('C2CST0301');
$this->verify_c2_template('C2CST0313');
$this->verify_c2_template('C2CST0314');
$this->verify_c2_template('C2CST0310');
$this->verify_c2_template('C2CST0298');
$this->verify_c2_template('C2CST0304');
$this->verify_c2_template('C2CST0315');
$this->verify_c2_template('C2COA1547');
$this->verify_c2_template('C2COA1539');
$this->verify_c2_template('C2COA1536');
$this->verify_c2_template('C2COA1548');
$this->verify_c2_template('C2COA1541');
$this->verify_c2_template('C2COA1549');
$this->verify_c2_template('C2COA1543');
$this->verify_c2_template('C2COA1545');
$this->verify_c2_template('C2COA1546');
$this->verify_c2_template('C2COA1537');
$this->verify_c2_template('C2CST0308');
$this->verify_c2_template('C2CST0316');
$this->verify_c2_template('C2CST0317');
$this->verify_c2_template('C2CST0306');
$this->verify_c2_template('C2COA1544');
$this->verify_c2_template('C2CST0311');
$this->verify_c2_template('C2COA1405');
$this->verify_c2_template('C2CST0220');
$this->verify_c2_template('C2COA1406');
$this->verify_c2_template('C2CST0219');
$this->verify_c2_template('C2CST0218');
$this->verify_c2_template('C2CST0217');
$this->verify_c2_template('C2COA1407');
$this->verify_c2_template('C2CST0216');
$this->verify_c2_template('C2BHB0218');
$this->verify_c2_template('C2CST0215');
$this->verify_c2_template('C2CST0214');
$this->verify_c2_template('C2COA1408');
$this->verify_c2_template('C2CST0213');
$this->verify_c2_template('C2COC0105');
$this->verify_c2_template('C2CST0211');
$this->verify_c2_template('C2CST0209');
$this->verify_c2_template('C2COA1399');
$this->verify_c2_template('C2COA1398');
$this->verify_c2_template('C2COA1400');
$this->verify_c2_template('C2COA1401');
$this->verify_c2_template('C2COA1403');
$this->verify_c2_template('C2COA1402');
$this->verify_c2_template('C2COA1404');
$this->verify_c2_template('C2PNL0755');
$this->verify_c2_template('C2PNL0754');
$this->verify_c2_template('C2HPS0059');
$this->verify_c2_template('C2HPS0058');
$this->verify_c2_template('C2HPS0057');
$this->verify_c2_template('C2HPS0056');
$this->verify_c2_template('C2HPS0055');
$this->verify_c2_template('C2BHB0219');
$this->verify_c2_template('C2BHB0220');
$this->verify_c2_template('C2BHB0223');
$this->verify_c2_template('C2BHB0221');
$this->verify_c2_template('C2BHB0222');
$this->verify_c2_template('C2RDM0234');
$this->verify_c2_template('C2RDM0244');
$this->verify_c2_template('C2RDM0235');
$this->verify_c2_template('C2RDM0236');
$this->verify_c2_template('C2RDM0237');
$this->verify_c2_template('C2RDM0238');
$this->verify_c2_template('C2RDM0240');
$this->verify_c2_template('C2RDM0241');
$this->verify_c2_template('C2PNL0756');
$this->verify_c2_template('C2PNL0758');
$this->verify_c2_template('C2VFR0355');
$this->verify_c2_template('C2VFR0354');
$this->verify_c2_template('C2PNL0757');
$this->verify_c2_template('C2PNL0759');
$this->verify_c2_template('C2BHB0215');
$this->verify_c2_template('C2BHB0214');
$this->verify_c2_template('C2BHB0213');
$this->verify_c2_template('C2BHB0217');
$this->verify_c2_template('C2RDM0257');
$this->verify_c2_template('C2RDM0262');
$this->verify_c2_template('C2RDM0263');
$this->verify_c2_template('C2RDM0261');
$this->verify_c2_template('C2RDM0260');
$this->verify_c2_template('C2HPS0082');
$this->verify_c2_template('C2VFR0340');
$this->verify_c2_template('C2HPS0083');
$this->verify_c2_template('C2HPS0080');
$this->verify_c2_template('C2PNL0795');
$this->verify_c2_template('C2PNL0796');
$this->verify_c2_template('C2PNL0797');
$this->verify_c2_template('C2PNL0793');
$this->verify_c2_template('C2COA1448');
$this->verify_c2_template('C2COA1445');
$this->verify_c2_template('C2CST0268');
$this->verify_c2_template('C2BHB0312');
    }

}
