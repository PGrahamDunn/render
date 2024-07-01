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
        $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $query_source = $request->query('source',null);
        $query_sku = strtoupper($request->query('sku', null));
        $request_ip = $request->ip();
        if (($query_sku) or (config('app.c2_preview_env') == 'local'))
        {
            $result = Visit::Create(['request_ip' => $request_ip, 'request_name' => $hostname,'source' => $query_source, 'sku' => $query_sku]);
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
        return view('dashboard');
        /*
        $key = $request->input('dashboard_key', null);
        if ($key == 'ZDTXRVK')
        {
            return view('dashboard');
        }
        else
        {
            return redirect(Route('home'));
        }
            */
    }

    public function seed_database()
    {
        set_time_limit(420);
        dump(now());
        $this->initalize_c2_1();
        $this->initalize_c2_2();
        $this->initalize_c2_3();
        dump(now());
    }
    
    public function initalize_c2_1()
    {
        $this->verify_c2_template('C2COA2046');
        $this->verify_c2_template('C2HFA0056');
        $this->verify_c2_template('C2BFW0002');
        $this->verify_c2_template('C2CST0739');
        $this->verify_c2_template('C2BFW0001');
        $this->verify_c2_template('C2COA2003');
        $this->verify_c2_template('C2ORN0387');
        $this->verify_c2_template('C2SPH0132');
        $this->verify_c2_template('C2CST0740');
        $this->verify_c2_template('C2TWL0112');
        $this->verify_c2_template('C2SPH0129');
        $this->verify_c2_template('C2COA2004');
        $this->verify_c2_template('C2ORN0281');
        $this->verify_c2_template('C2TWL0160');
        $this->verify_c2_template('C2ORN0272');
        $this->verify_c2_template('C2HPS0166');
        $this->verify_c2_template('C2PHF0341');
        $this->verify_c2_template('C2COA2094');
        $this->verify_c2_template('C2ORN0384');
        $this->verify_c2_template('C2SPH0126');
        $this->verify_c2_template('C2TWL0161');
        $this->verify_c2_template('C2CVS0358');
        $this->verify_c2_template('C2COA1462');
        $this->verify_c2_template('C2SPH0131');
        $this->verify_c2_template('C2HFA0062');
        $this->verify_c2_template('C2PHF0476');
        $this->verify_c2_template('C2BHB0782');
        $this->verify_c2_template('C2ORN0502');
        $this->verify_c2_template('C2PHF0489');       
        $this->verify_c2_template('C2ORN0265');
        $this->verify_c2_template('C2HPS0082');
        $this->verify_c2_template('C2CST0614');
        $this->verify_c2_template('C2SPH0130');
        $this->verify_c2_template('C2TWL0107');
        $this->verify_c2_template('C2ORN0267');
        $this->verify_c2_template('C2SPH0125');
        $this->verify_c2_template('C2VFR0423');
        $this->verify_c2_template('C2PHF0543');
        $this->verify_c2_template('C2PHF0497');
        $this->verify_c2_template('C2PHF0542');
        $this->verify_c2_template('C2BFW0010');
        $this->verify_c2_template('C2PNL0951');
        $this->verify_c2_template('C2TWL0113');
        $this->verify_c2_template('C2TWL0090');
        $this->verify_c2_template('C2BFW0012');
        $this->verify_c2_template('C2ORN0276');
        $this->verify_c2_template('C2COA1752');
        $this->verify_c2_template('C2DWW0006');
        $this->verify_c2_template('C2SPH0150');
        $this->verify_c2_template('C2ORN0270');
        $this->verify_c2_template('C2ORN0389');
        $this->verify_c2_template('C2PHF0498');
        $this->verify_c2_template('C2ORN0388');
        $this->verify_c2_template('C2PHF0545');
        $this->verify_c2_template('C2TWL0114');
        $this->verify_c2_template('C2SPH0139');
        $this->verify_c2_template('C2CVS0377');
        $this->verify_c2_template('C2BHB0646');
        $this->verify_c2_template('C2CST0271');
        $this->verify_c2_template('C2PHF0547');
        $this->verify_c2_template('C2FFW0042');
        $this->verify_c2_template('C2BFW0008');
        $this->verify_c2_template('C2COA1521');
        $this->verify_c2_template('C2TWL0138');
        $this->verify_c2_template('C2PHF0546');
        $this->verify_c2_template('C2BHB0783');
        $this->verify_c2_template('C2DWW0007');
        $this->verify_c2_template('C2BHB0312');
        $this->verify_c2_template('C2COC0102');
        $this->verify_c2_template('C2PHF0345');
        $this->verify_c2_template('C2COA1459');
        $this->verify_c2_template('C2COA1943');
        $this->verify_c2_template('C2TWL0056');
        $this->verify_c2_template('C2AKC0098');
        $this->verify_c2_template('C2COA1520');
        $this->verify_c2_template('C2ORN0385');
        $this->verify_c2_template('C2PDL0019');
        $this->verify_c2_template('C2COA1546');
        $this->verify_c2_template('C2CST0633');
        $this->verify_c2_template('C2AKC0123');
        $this->verify_c2_template('C2COA1909');
        $this->verify_c2_template('C2COA1750');
        $this->verify_c2_template('C2SPH0149');
        $this->verify_c2_template('C2COA1460');
        $this->verify_c2_template('C2CST0637');
        $this->verify_c2_template('C2MGT0696');
        $this->verify_c2_template('C2ORN0558');
        $this->verify_c2_template('C2COA1536');
        $this->verify_c2_template('C2MGT0695');
        $this->verify_c2_template('C2ORN0264');
        $this->verify_c2_template('C2COA1545');
        $this->verify_c2_template('C2CST0294');
        $this->verify_c2_template('C2CST0298');
        $this->verify_c2_template('C2FFT0032');
        $this->verify_c2_template('C2BHB0733');
        $this->verify_c2_template('C2CVS0148');
        $this->verify_c2_template('C2COA1551');
        $this->verify_c2_template('C2SPH0146');
        $this->verify_c2_template('C2COA1911');
        $this->verify_c2_template('C2CST0213');
    }
    public function initalize_c2_2()
    {
        $this->verify_c2_template('C2COA1915');
        $this->verify_c2_template('C2COA1908');
        $this->verify_c2_template('C2MGT0677');
        $this->verify_c2_template('C2CST0311');
        $this->verify_c2_template('C2DWT0019');
        $this->verify_c2_template('C2COA2002');
        $this->verify_c2_template('C2CST0293');
        $this->verify_c2_template('C2PHF0512');
        $this->verify_c2_template('C2TWL0047');
        $this->verify_c2_template('C2COA1913');
        $this->verify_c2_template('C2MGT0672');
        $this->verify_c2_template('C2SPH0133');
        $this->verify_c2_template('C2TWL0119');
        $this->verify_c2_template('C2COA1399');
        $this->verify_c2_template('C2PTC0048');
        $this->verify_c2_template('C2CST0297');
        $this->verify_c2_template('C2BHB0700');
        $this->verify_c2_template('C2MGT0669');
        $this->verify_c2_template('C2CST0618');
        $this->verify_c2_template('C2RLE0093');
        $this->verify_c2_template('C2PNL0808');
        $this->verify_c2_template('C2COA1945');
        $this->verify_c2_template('C2WPT0019');
        $this->verify_c2_template('C2RDM0264');
        $this->verify_c2_template('C2COA1896');
        $this->verify_c2_template('C2COC0185');
        $this->verify_c2_template('C2TWL0179');
        $this->verify_c2_template('C2RLE0094');
        $this->verify_c2_template('C2COA2095');
        $this->verify_c2_template('C2COA1903');
        $this->verify_c2_template('C2ORN0266');
        $this->verify_c2_template('C2COA1916');
        $this->verify_c2_template('C2CVS0346');
        $this->verify_c2_template('C2TWL0055');
        $this->verify_c2_template('C2CST0317');
        $this->verify_c2_template('C2RDM0344');
        $this->verify_c2_template('C2TWL0117');
        $this->verify_c2_template('C2WPT0020');
        $this->verify_c2_template('C2MGT0676');
        $this->verify_c2_template('C2FFW0049');
        $this->verify_c2_template('C2TWL0050');
        $this->verify_c2_template('C2CST0214');
        $this->verify_c2_template('C2HPS0057');
        $this->verify_c2_template('C2CST0636');
        $this->verify_c2_template('C2CVS0357');
        $this->verify_c2_template('C2ORN0286');
        $this->verify_c2_template('C2CST0634');
        $this->verify_c2_template('C2ORN0275');
        $this->verify_c2_template('C2MGT0683');
        $this->verify_c2_template('C2BHB0214');
        $this->verify_c2_template('C2CST0307');
        $this->verify_c2_template('C2BHB0622');
        $this->verify_c2_template('C2TWL0106');
        $this->verify_c2_template('C2VFR0419');
        $this->verify_c2_template('C2BFW0011');
        $this->verify_c2_template('C2ORN0386');
        $this->verify_c2_template('C2HFA0063');
        $this->verify_c2_template('C2MGT0325');
        $this->verify_c2_template('C2COA1406');
        $this->verify_c2_template('C2TWL0116');
        $this->verify_c2_template('C2COC0181');
        $this->verify_c2_template('C2VFR0492');
        $this->verify_c2_template('C2HPS0055');
        $this->verify_c2_template('C2TWL0120');
        $this->verify_c2_template('C2COA1506');
        $this->verify_c2_template('C2CST0669');
        $this->verify_c2_template('C2COA2096');
        $this->verify_c2_template('C2CVF0131');
        $this->verify_c2_template('C2MGT0636');
        $this->verify_c2_template('C2COA1405');
        $this->verify_c2_template('C2COA1864');
        $this->verify_c2_template('C2AKC0101');
        $this->verify_c2_template('C2CST0590');
        $this->verify_c2_template('C2BHB0878');
        $this->verify_c2_template('C2ORN0282');
        $this->verify_c2_template('C2ORN0458');
        $this->verify_c2_template('C2FFT0034');
        $this->verify_c2_template('C2PTC0049');
        $this->verify_c2_template('C2BHB0454');
        $this->verify_c2_template('C2PDL0020');
        $this->verify_c2_template('C2ORN0503');
        $this->verify_c2_template('C2VFR0332');
        $this->verify_c2_template('C2TWL0159');
        $this->verify_c2_template('C2MGT0328');
        $this->verify_c2_template('C2PHF0541');
        $this->verify_c2_template('C2BHB0647');
        $this->verify_c2_template('C2BHB0734');
        $this->verify_c2_template('C2CVS0320');
        $this->verify_c2_template('C2CVS0146');
        $this->verify_c2_template('C2COA1560');
        $this->verify_c2_template('C2COA2099');
        $this->verify_c2_template('C2COC0184');
        $this->verify_c2_template('C2CST0323');
        $this->verify_c2_template('C2CST0671');
        $this->verify_c2_template('C2VFR0470');
        $this->verify_c2_template('C2MGT0320');
        $this->verify_c2_template('C2PDL0021');
        $this->verify_c2_template('C2COA1898');
        $this->verify_c2_template('C2TWL0105');
        $this->verify_c2_template('C2TWL0162');
    }
    public function initalize_c2_3()
    {
        $this->verify_c2_template('C2WPT0023');
        $this->verify_c2_template('C2SPH0147');
        $this->verify_c2_template('C2VFR0379');
        $this->verify_c2_template('C2COC0107');
        $this->verify_c2_template('C2HFA0066');
        $this->verify_c2_template('C2CVF0048');
        $this->verify_c2_template('C2AKC0124');
        $this->verify_c2_template('C2CVF0102');
        $this->verify_c2_template('C2PHF0499');
        $this->verify_c2_template('C2BFW0017');
        $this->verify_c2_template('C2BHB0221');
        $this->verify_c2_template('C2FFW0046');
        $this->verify_c2_template('C2CVS0378');
        $this->verify_c2_template('C2PHF0513');
        $this->verify_c2_template('C2COA1531');
        $this->verify_c2_template('C2COA1537');
        $this->verify_c2_template('C2MGT0668');
        $this->verify_c2_template('C2TWL0091');
        $this->verify_c2_template('C2VFR0408');
        $this->verify_c2_template('C2VFR0420');
        $this->verify_c2_template('C2COC0105');
        $this->verify_c2_template('C2ORN0433');
        $this->verify_c2_template('C2COC0201');
        $this->verify_c2_template('C2BHB0314');
        $this->verify_c2_template('C2PNL1068');
        $this->verify_c2_template('C2VFR0483');
        $this->verify_c2_template('C2BHB0654');
        $this->verify_c2_template('C2BHB0368');
        $this->verify_c2_template('C2PHF0533');
        $this->verify_c2_template('C2PHF0485');
        $this->verify_c2_template('C2MGT0611');
        $this->verify_c2_template('C2CST0295');
        $this->verify_c2_template('C2TWL0189');
        $this->verify_c2_template('C2RDM0263');
        $this->verify_c2_template('C2COA1401');
        $this->verify_c2_template('C2BHB0653');
        $this->verify_c2_template('C2COA1549');
        $this->verify_c2_template('C2COC0204');
        $this->verify_c2_template('C2CVS0348');
        $this->verify_c2_template('C2SPH0141');
        $this->verify_c2_template('C2BFW0007');
        $this->verify_c2_template('C2BHB0223');
        $this->verify_c2_template('C2CST0315');
        $this->verify_c2_template('C2CVF0128');
        $this->verify_c2_template('C2TWL0187');
        $this->verify_c2_template('C2RDM0343');
        $this->verify_c2_template('C2HPS0158');
        $this->verify_c2_template('C2PTC0046');
        $this->verify_c2_template('C2TWL0108');
        $this->verify_c2_template('C2BHB0459');
        $this->verify_c2_template('C2CVS0161');
        $this->verify_c2_template('C2TWL0137');
        $this->verify_c2_template('C2AKC0126');
        $this->verify_c2_template('C2ORN0271');
        $this->verify_c2_template('C2TWL0049');
        $this->verify_c2_template('C2COA1914');
        $this->verify_c2_template('C2COA1563');
        $this->verify_c2_template('C2COA1504');
        $this->verify_c2_template('C2CST0629');
        $this->verify_c2_template('C2MGT0670');
        $this->verify_c2_template('C2SPH0152');
        $this->verify_c2_template('C2PHF0479');
        $this->verify_c2_template('C2PHF0548');
        $this->verify_c2_template('C2COC0202');
        $this->verify_c2_template('C2ORN0287');
        $this->verify_c2_template('C2CVF0132');
        $this->verify_c2_template('C2PHF0335');
        $this->verify_c2_template('C2VFR0343');
        $this->verify_c2_template('C2VFR0704');
        $this->verify_c2_template('C2COA1902');
        $this->verify_c2_template('C2CST0316');
        $this->verify_c2_template('C2BHB0702');
        $this->verify_c2_template('C2CVS0162');
        $this->verify_c2_template('C2DHS0059');
        $this->verify_c2_template('C2MGT0680');
        $this->verify_c2_template('C2MGT0692');
        $this->verify_c2_template('C2COA1404');
        $this->verify_c2_template('C2HPS0155');
        $this->verify_c2_template('C2SPH0136');
        $this->verify_c2_template('C2HPS0156');
        $this->verify_c2_template('C2BHB0470');
        $this->verify_c2_template('C2CST0303');
        $this->verify_c2_template('C2TWL0118');
        $this->verify_c2_template('C2RDM0320');
        $this->verify_c2_template('C2HPS0083');
        $this->verify_c2_template('C2RDM0260');
        $this->verify_c2_template('C2BHB0736');
        $this->verify_c2_template('C2BHB0648');
        $this->verify_c2_template('C2HPS0146');
        $this->verify_c2_template('C2MGT0697');
        $this->verify_c2_template('C2COC0183');
        $this->verify_c2_template('C2COA1542');
        $this->verify_c2_template('C2COA1445');
        $this->verify_c2_template('C2PNL0860');
        $this->verify_c2_template('C2COA1507');
        $this->verify_c2_template('C2BHB0220');
        $this->verify_c2_template('C2HPS0105');
        $this->verify_c2_template('C2FFT0030');
        $this->verify_c2_template('C2ORN0432');
        $this->verify_c2_template('C2PHF0534');
    }
}
