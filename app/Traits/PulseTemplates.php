<?php

namespace App\Traits;

use App\Models\C2Design;
use App\Models\C2Element;
use App\Models\C2Item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

trait PulseTemplates
{
    public function verify_c2_template(string $sku)
    {
        //$this->delete_c2_template($sku);
        $is_valid = false;
        $c2item = C2Item::where('name',strtoupper($sku))->first();
        if(!$c2item)
        {
            $response_template = Http::timeout(60)->withHeaders(['apiKey' => config('app.pulse_key')])->get(config('app.pulse_endpoint') . '/api/Templates/GetTemplateInfo/' . strtoupper($sku));
            $pulse_template = json_decode($response_template->body());
            if (isset($pulse_template->Name)) 
            {
                $new_c2item = C2Item::Create(['name' => trim($pulse_template->Name), 'code' => $pulse_template->Code]);
                $pulse_template_elements = $pulse_template->TemplateElements;
                if ($pulse_template_elements)
                {
                    foreach($pulse_template_elements as $element)
                    {
                        $new_element = C2Element::Create(['c2_item_id' => $new_c2item->id, 'name' => $element->ElementName, 'default_text' => $element->Text, 'is_text' => $element->IsText]);
                        if(strtolower($element->ElementName) == 'mascot')
                        {
                            $response_design = Http::timeout(60)->withHeaders(['apiKey' => config('app.pulse_key')])->get(config('app.pulse_endpoint') . "/api/Designs/GetDesigns?template=$pulse_template->Name");
                            $designs = json_decode($response_design->body());
                            foreach ($designs as $design) {
                                $new_c2design = C2Design::Create(['c2_element_id' => $new_element->id, 'name' => $design->DesignName]);
                            }
                        }
                    }
                }
                $is_valid = true;
                //dd($pulse_template);               
            }
        }
        else
        {
            //dd('found');
            $is_valid = true;
        }
        return $is_valid;
    }

    public function reset_c2_template(string $sku)
    {
        $this->delete_c2_template($sku);
        $this->verify_c2_template($sku);
    }

    public function delete_c2_template(string $sku)
    {
        $c2item = C2Item::where('name',strtoupper($sku))->first();
        if ($c2item)
        {
            $deleted_c2item = DB::table('c2_items')->where('id',$c2item->id)->delete();
        }
    }

}