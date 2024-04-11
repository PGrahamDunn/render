<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\Session;
use Illuminate\Support\Str;

class Preview extends Component
{
    public $query_sku;
    public $query_select;
    public $query_download;
    public $query_vendor;
    public $request_host;

    #[Session]
    public $select_it_enabled = true;
    #[Session]
    public $personalize_it_enabled = false;
    #[Session]
    public $render_it_enabled = false;
    #[Session]
    public $download_it_enabled = false;

    #[Session]
    public $template_name;
    #[Session]
    public $template_code;
    #[Session]
    public $template_elements;

    #[Session]
    public $element_line_1;
    #[Session]
    public $element_line_1_enabled;
    #[Session]
    public $element_line_2;
    #[Session]
    public $element_line_2_enabled;
    #[Session]
    public $element_line_3;
    #[Session]
    public $element_line_3_enabled;
    #[Session]
    public $element_mascot;
    #[Session]
    public $element_mascot_enabled;
    #[Session]
    public $element_map_coordinates;
    #[Session]
    public $element_map_coordinates_enabled;
    #[Session]
    public $personalization_string;

    #[Session]
    public $mascots;

    #[Session]
    public $error_message;

    #[Session]
    public $render_is_set = false;

    #[Session]
    public $local_file_name;
    #[Session]
    public $download_file_name;

    public function mount()
    {
        $this->reset_variables();
        if (strlen($this->query_sku > 2)) 
        {
            $this->template_name = $this->query_sku;
            $this->select_it_enabled = false;
            $this->select_it();
        }
        if($this->query_select)
        {
            $this->select_it_enabled = true;
        }
    }

    public function reset_variables()
    {
        $this->select_it_enabled = true;
        $this->personalize_it_enabled = false;
        $this->render_it_enabled = false;
        $this->download_it_enabled = false;
        $this->template_name = '';
        $this->template_code = '';
        $this->template_elements = null;
        $this->element_line_1 = '';
        $this->element_line_1_enabled = false;
        $this->element_line_2 = '';
        $this->element_line_2_enabled = false;
        $this->element_line_3 = '';
        $this->element_line_3_enabled = false;
        $this->element_mascot = '';
        $this->element_mascot_enabled = false;
        $this->element_map_coordinates = '';
        $this->element_map_coordinates_enabled = false;
        $this->personalization_string = '';
        $this->mascots = null;
        $this->error_message = '';
        $this->render_is_set = false;
        $this->local_file_name = '';
        $this->download_file_name = '';
    }

    public function select_it()
    {
        set_time_limit(120);
        $this->error_message = '';
        $template_response = Http::withHeaders(['apiKey' => config('app.pulse_key')])->get(config('app.pulse_endpoint') . '/api/Templates/GetTemplateInfo/' . $this->template_name);
        $pulse_template = json_decode($template_response->body());
        if ($pulse_template) {
            $this->template_code = $pulse_template->Code;
            $sql_elements_result = $pulse_template->TemplateElements;
            $this->template_elements = $sql_elements_result;
            foreach ($this->template_elements as $template_element) {
                if (Str::lower($template_element->ElementName) == 'mascot') {
                    $this->element_mascot_enabled = true;
                    $design_response = Http::withHeaders(['apiKey' => config('app.pulse_key')])->get(config('app.pulse_endpoint') . "/api/Designs/GetDesigns?template=$this->template_name");
                    $this->mascots = json_decode($design_response->body());
                    //dd($this->mascots);
                    //$this->mascots = DB::connection('sqlsrv')->table('designs')->select('designid','name')->where('Name','like','%' . $this->template_name . '%')->get();
                } elseif (Str::lower($template_element->ElementName) == 'line 1') {
                    $this->element_line_1_enabled = true;
                } elseif (Str::lower($template_element->ElementName) == 'line 2') {
                    $this->element_line_2_enabled = true;
                } elseif (Str::lower($template_element->ElementName) == 'line 3') {
                    $this->element_line_3_enabled = true;
                } elseif (Str::lower($template_element->ElementName) == 'map coordinates') {
                    $this->element_map_coordinates_enabled = true;
                } else {
                    $this->error_message = 'template element ' . $template_element->ElementName . ' is undefined.';
                }
            }
        } else {
            $this->error_message = "Invalid SKU.";
        }
        if (strlen($this->error_message) < 2) {
            if (count($this->template_elements) == 0) {
                $this->render_it_enabled = true;
                $this->select_it_enabled = false;
            } else {
                $this->personalize_it_enabled = true;
                $this->select_it_enabled = false;
            }
        }
    }

    public function personalize_it()
    {
        // generate personilication string
        //Personalizations[0].ElementName=LINE%201&Personalizations[0].Text=Dalton&Personalizations[0].IsText=true
        //replace ands str_replace('&', '%26', $text);
        $this->error_message = '';
        $this->personalization_string = '';
        $index = 0;
        foreach ($this->template_elements as $template_element) {
            if (strtolower($template_element->ElementName) == 'line 1') {
                $this->personalization_string = $this->personalization_string . '&Personalizations[' . $index . '].ElementName=' . str_replace('&', '%26', $template_element->ElementName) . '&Personalizations[' . $index . '].Text=' . str_replace('&', '%26', trim($this->element_line_1)) . '&Personalizations[' . $index . '].IsText=true';
            } elseif (strtolower($template_element->ElementName) == 'line 2') {
                $this->personalization_string = $this->personalization_string . '&Personalizations[' . $index . '].ElementName=' . str_replace('&', '%26', $template_element->ElementName) . '&Personalizations[' . $index . '].Text=' . str_replace('&', '%26', trim($this->element_line_2)) . '&Personalizations[' . $index . '].IsText=true';
            } elseif (strtolower($template_element->ElementName) == 'line 3') {
                $this->personalization_string = $this->personalization_string . '&Personalizations[' . $index . '].ElementName=' . str_replace('&', '%26', $template_element->ElementName) . '&Personalizations[' . $index . '].Text=' . str_replace('&', '%26', trim($this->element_line_3)) . '&Personalizations[' . $index . '].IsText=true';
            } elseif (strtolower($template_element->ElementName) == 'map coordinates') {
                $this->personalization_string = $this->personalization_string . '&Personalizations[' . $index . '].ElementName=' . str_replace('&', '%26', $template_element->ElementName) . '&Personalizations[' . $index . '].Text=' . str_replace('&', '%26', trim($this->element_map_coordinates)) . '&Personalizations[' . $index . '].IsText=true';
            } elseif (strtolower($template_element->ElementName) == 'mascot') {
                if (($this->element_mascot == '-1') or (strlen($this->element_mascot) == 0)) {
                    $this->error_message = 'No mascot selected.';
                } else {
                    $this->personalization_string =  $this->personalization_string . '&Personalizations[' . $index . '].ElementName=' . str_replace('&', '%26', $template_element->ElementName) . '&Personalizations[' . $index . '].Text=' . str_replace('&', '%26', trim($this->element_mascot)) . '&Personalizations[' . $index . '].IsText=false';
                }
            }
            $index++;
        }
        if (strlen($this->error_message) < 2) {
            $this->render_it_enabled = true;
            $this->download_it_enabled = false;
            $this->render_is_set = false;
        } else {
            $this->render_it_enabled = false;
        }
    }

    public function render_it()
    {
        $this->error_message = '';
        set_time_limit(120);
        $response_order = Http::withHeaders(['apiKey' => config('app.pulse_key')])->get(config('app.pulse_endpoint') . "/api/Orders/Render?OrderType=print-template&Product1&TemplateCode=$this->template_code$this->personalization_string");
        $this->local_file_name =  substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 7);
        Storage::disk('local')->put('/public/C2/' . $this->template_name . '/' . $this->local_file_name . '.png', $response_order->body());
        if (strlen($this->error_message) < 2) {
            $this->download_it_enabled = true;
            $this->download_file_name = strtoupper($this->template_name);
        } else {
            $this->download_it_enabled = false;
        }
        $this->render_is_set = true;
        //redirect(route('preview'));
    }

    public function download_it()
    {
        return response()->download(storage_path('app/public/C2/' . $this->template_name . '/' . $this->local_file_name . '.png'), str_replace(' ', '_', $this->download_file_name . '.png'));
    }

    public function render()
    {
        return view('livewire.preview');
    }
}
