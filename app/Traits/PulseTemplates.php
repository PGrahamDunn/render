<?php

namespace App\Traits;

use App\Models\C2Design;
use App\Models\C2Element;
use App\Models\C2Item;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

trait PulseTemplates
{
    /**************************************************************************************************
    *  verify template in local database
    * return true or false
    * ************************************************************************************************/
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

    /**************************************************************************************************
    *  reset template in local database by deleting then verifying
    * return true or false
    * ************************************************************************************************/
    public function reset_c2_template(string $sku)
    {
        $this->delete_c2_template($sku);
        $this->verify_c2_template($sku);
    }

    /**************************************************************************************************
    *  delete template in local database
    * return true or false
    * ************************************************************************************************/
    public function delete_c2_template(string $sku)
    {
        $c2item = C2Item::where('name',strtoupper($sku))->first();
        if ($c2item)
        {
            $deleted_c2item = DB::table('c2_items')->where('id',$c2item->id)->delete();
        }
    }

    /**************************************************************************************************
    * generate json string from elements and default text in local db  
    * assume sku has been verified
    * return json string
    * ************************************************************************************************/
    public function get_sample_json($sku) : string
    {
        $sample = [];
        $c2item = C2Item::where('name',strtoupper($sku))->first();
        if ($c2item)
        {
            $c2elements = C2Element::where('c2_item_id',$c2item->id)->get();
            foreach($c2elements as $c2element)
            {
                $sample = Arr::add($sample, $c2element->name,$c2element->default_text);
            }
        }
        return json_encode($sample);
    }

    /**************************************************************************************************
    * check json string for 'icon' and 'state shape' as possible masconts  
    * assume sku has been verified
    * return updated lines
    * ************************************************************************************************/
    public function normalize_elements(string $sku, string $pulse_lines) : string
    {
        $valid = true;
        $normalized_array = [];
        $lines = json_decode($pulse_lines, true);
        $lowercase_keys =  array_change_key_case($lines, CASE_LOWER);
        $map_coordinates = Arr::exists($lowercase_keys, 'map coordinates'); // if map coordinates present will use to add mascot
        $c2item = C2Item::where('name',strtoupper($sku))->first();
        if ($c2item)
        {
            $c2elements = C2Element::where('c2_item_id',$c2item->id)->get();
            foreach($c2elements as $c2element)
            {
                $exists = Arr::exists($lowercase_keys, strtolower($c2element->name));
                if ($exists)
                {
                    $normalized_array = Arr::add($normalized_array, $c2element->name,$lowercase_keys[strtolower($c2element->name)]);
                }
                elseif (strtolower($c2element->name) == 'mascot')
                {
                    $mascot = null;
                    if (Arr::exists($lowercase_keys, 'icon'))
                    {   
                        $mascot = $this->check_design($sku, $lowercase_keys['icon']);
                        //$normalized_array = Arr::add($normalized_array, $c2element->name,$lowercase_keys['icon']);
                    }
                    elseif (Arr::exists($lowercase_keys, 'state shape'))
                    {
                        $mascot = $this->check_design($sku, $lowercase_keys['state shape']);
                        //$normalized_array = Arr::add($normalized_array, $c2element->name,$lowercase_keys['state shape']);
                    }
                    elseif ($map_coordinates)
                    {
                        $mascot = ''; //$this->check_design($sku, $lowercase_keys['mascot']);
                        //$normalized_array = Arr::add($normalized_array, $c2element->name,null);
                    }
                    elseif (Arr::exists($lowercase_keys, 'mascot'))
                    {
                        $mascot = $this->check_design($sku, $lowercase_keys['mascot']);
                        //$normalized_array = Arr::add($normalized_array, $c2element->name,$lowercase_keys['mascot']);
                    }
                    else
                    {
                        $valid = false;
                    }
                    if (!is_null($mascot))
                    {
                        $normalized_array = Arr::add($normalized_array, $c2element->name, $mascot);
                    }
                    else
                    {
                        $valid = false;
                    }   
                }
                else
                {
                    $valid = false;
                }
            }
        }
        if ($valid)
        {
            return json_encode($normalized_array);
        }
        else
        {
            return '';
        }
    }

    /**************************************************************************************************
    *  verify json string contains right elements for pulse order from local database
    * assume sku has been verified
    * return true or false
    * ************************************************************************************************/
    public function check_order(string $sku, string $pulse_lines)
    {
        $valid = true;
        $lines = $this->normalize_elements($sku, $pulse_lines);
        $lines = json_decode($lines, true);
        if ($lines)
        {
            $c2item = C2Item::where('name',strtoupper($sku))->first();
            if ($c2item)
            {
                $c2elements = C2Element::where('c2_item_id',$c2item->id)->get();
                foreach($c2elements as $c2element)
                {
                    $exists = Arr::exists($lines, $c2element->name);
                    if (!$exists)
                    {
                        $valid = false;
                    }
                }
            }
        }
        else
        {
            $valid = false;
        }
        return $valid;
    }

    /**************************************************************************************************
    * check design
    * assume sku has been verified
    * assume lines have been checked
    * return true or false
    * ************************************************************************************************/
    public function check_design(string $sku, string $value)
    {   
        $c2item = C2Item::where('name',strtoupper($sku))->first();
        if ($c2item)
        {
            $element = $c2item->C2elements()->where('name','mascot')->first();
            if ($element)
            {
                if (in_array(trim(strtolower($value)), ['bear', 'compass']))   
                {
                    $order_element_text = trim($value) . ' -' . $sku;
                }
                else
                {
                    $order_element_text = trim($value) . '-' . $sku;
                }
                $design = $element->C2Designs()->where('name',$order_element_text)->first();
                if ($design)
                {
                    return $design->name;
                }
                else
                {
                    return null;
                }
            }
        }
        else
        {
            return null;
        }
    }

    /**************************************************************************************************
    * build personalization string from local database
    * assume sku has been verified
    * assume lines have been checked
    * return string
    * ************************************************************************************************/
    public function build_personalization_string(string $sku, string $pulse_lines)
    {
        // generate personilication string
        //Personalizations[0].ElementName=LINE%201&Personalizations[0].Text=Dalton&Personalizations[0].IsText=true
        //replace ands str_replace('&', '%26', $text);
        $valid = true;
        $lines = $this->normalize_elements($sku, $pulse_lines);
        $elements = json_decode($lines, true);
        $c2item = C2Item::where('name',strtoupper($sku))->first();
        if ($c2item)
        {
            $c2elements = C2Element::where('c2_item_id',$c2item->id)->get();
            if ($elements)
            {
                $personalization_string = '';
                $index = 0;
                    foreach($c2elements as $c2element)
                    {
                        if (strtolower($c2element->name) == 'mascot')
                        {
                            $personalization_string = $personalization_string . '&Personalizations[' . $index . '].ElementName=' . str_replace('&', '%26', $c2element->name) . '&Personalizations[' . $index . '].Text=' . str_replace('&', '%26', trim($elements[$c2element->name])) . '&Personalizations[' . $index . '].IsText=false';
                        }
                        else
                        {
                            $personalization_string = $personalization_string . '&Personalizations[' . $index . '].ElementName=' . str_replace('&', '%26', $c2element->name) . '&Personalizations[' . $index . '].Text=' . str_replace('&', '%26', trim($elements[$c2element->name])) . '&Personalizations[' . $index . '].IsText=true';
                        }
                        $index++;
                    }
            }
            else
            {
                $valid = false;
            }
        }    
        else
        {
            $valid = false;
        }
        if ($valid)
        {
            return $personalization_string;
        }
        else
        {
            return $valid;
        }
    }

    /**************************************************************************************************
    * check if order exists in pulse
    * assume sku has been verified
    * assume lines have been checked
    * return true or false
    * ************************************************************************************************/
    public function check_pulse(string $sku, string $batch_number)
    {
        $c2item = C2Item::where('name',strtoupper($sku))->first();
        if ($c2item)
        {
            $response = Http::timeout(60)->withHeaders(['apiKey' => config('app.pulse_key')])->get(config('app.pulse_endpoint') . "/api/Orders/GetInfo/?OrderType=print-template&ProductCode=Product1&TemplateCode=$c2item->code&Job=$batch_number");
            $result = json_decode($response->body(), true);
            if (array_key_exists('Name', $result)) 
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }

    /**************************************************************************************************
    *  submit order to pulse
    * assume sku has been verified
    * assume lines have been checked
    * return true or false
    * ************************************************************************************************/
    public function submit_order(string $sku, string $batch_number, string $pulse_lines)
    {
        $valid = false;
        $lines = $this->normalize_elements($sku, $pulse_lines);
        $personilizations = $this->build_personalization_string($sku,$lines);
        if ($personilizations)
        {
            $c2item = C2Item::where('name',strtoupper($sku))->first();
            if ($c2item)
            {
                dump($personilizations);
                $response = Http::withHeaders(['apiKey' => config('app.pulse_key')])->post(config('app.pulse_endpoint') . "/api/Orders/Submit?OrderType=print-template&ProductCode=Product1&TemplateCode=$c2item->code&Job=$batch_number&$personilizations");
                if ($response->getStatusCode() == 200) 
                {
                    $valid = true;
                }
            }
        }
        return $valid;
    }
}