<?php

namespace App\Livewire;

use App\Models\C2Item;
use App\Models\Design;
use App\Traits\Counters;
use App\Traits\PulseTemplates;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\Session;
use Livewire\Attributes\Js;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class Preview extends Component
{
    use Counters, PulseTemplates;

    public $query_sku;
    public $query_source;

    #[Session]
    public $choose_it_enabled = true;
    #[Session]
    public $select_it_enabled = true;
    #[Session]
    public $personalize_it_enabled = false;
    #[Session]
    public $render_it_enabled = false;
    #[Session]
    public $download_it_enabled = false;
    #[Session]
    public $copy_it_enabled = false;
    #[Session]
    public $submit_it_enabled = false;

    #[Session]
    public $template_name;
    #[Session]
    public $local_template;

    #[Session]
    public $element_line_1;
    public $element_line_1_placeholder;
    #[Session]
    public $element_line_1_enabled;
    #[Session]
    public $element_line_2;
    public $element_line_2_placeholder;
    #[Session]
    public $element_line_2_enabled;
    #[Session]
    public $element_line_3;
    public $element_line_3_placeholder;
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
    public $customization_string;

    public $status_message;
    public $show_message;
    public $message_type;

    #[Session]
    public $preview_valid;

    #[Session]
    public $render_is_set = false;
    public $render_is_available = true;

    #[Session]
    public $local_file_name;
    #[Session]
    public $download_file_name;
    #[Session]
    public $pulse_batch_id;

    public function mount()
    {
        $this->reset_variables();
        if (strlen($this->query_sku > 2)) {
            $this->template_name = strtoupper(trim($this->query_sku));
            if ($this->verify_c2_template($this->template_name)) {
                $this->select_it();
            } else {
                $this->status_message = "Invalid SKU.";
                $this->message_type = 'error';
                $this->show_message = true;
                $this->preview_valid = false;
            }
        }
    }

    #[Js]
    public function copyTo()
    {
        return <<<'JS'
        alert('here - copyTo');
        try {
            var copy_field = document.getElementById('copy_customization');
            copy_field.select();
            document.execCommand('copy');
            alert(copy_field.value);
            alert('Personilization copied to clipboard.');
            } catch (err) {
            alert(err.message);
            }
        JS;
    }

    public function reset_variables()
    {
        $this->choose_it_enabled = true;
        $this->select_it_enabled = true;
        $this->personalize_it_enabled = false;
        $this->render_it_enabled = false;
        $this->download_it_enabled = false;
        $this->copy_it_enabled = false;
        $this->submit_it_enabled = false;
        $this->template_name = '';
        $this->element_line_1 = '';
        $this->element_line_1_placeholder = '';
        $this->element_line_1_enabled = false;
        $this->element_line_2 = '';
        $this->element_line_2_placeholder = '';
        $this->element_line_2_enabled = false;
        $this->element_line_3 = '';
        $this->element_line_3_placeholder = '';
        $this->element_line_3_enabled = false;
        $this->element_mascot = '';
        $this->element_mascot_enabled = false;
        $this->element_map_coordinates = '';
        $this->element_map_coordinates_enabled = false;
        $this->personalization_string = '';
        $this->customization_string = '';
        $this->status_message = '';
        $this->show_message = false;
        $this->message_type = '';
        $this->preview_valid = true;
        $this->render_is_set = false;
        $this->render_is_available = true;
        $this->local_file_name = '';
        $this->download_file_name = '';
        $this->pulse_batch_id = '';
    }

    public function select_it()
    {
        if ($this->verify_c2_template($this->template_name)) {
            $this->local_template = C2Item::where('name', $this->template_name)->first();
            $this->preview_valid = true;
            $this->status_message = '';
            $this->show_message = false;
            //$elements_result = $this->web_get_template();
            //$elements_result = $this->local_get_template();
            //}
            foreach ($this->local_template->c2elements as $c2element) {
                if (Str::lower($c2element->name) == 'mascot') {
                    $this->element_mascot_enabled = true;
                    //$designs_result = $this->web_get_mascots();
                    //}
                } elseif (Str::lower($c2element->name) == 'line 1') {
                    $this->element_line_1_enabled = true;
                    $this->element_line_1_placeholder = $c2element->default_text;
                } elseif (Str::lower($c2element->name) == 'line 2') {
                    $this->element_line_2_enabled = true;
                    $this->element_line_2_placeholder = $c2element->default_text;
                } elseif (Str::lower($c2element->name) == 'line 3') {
                    $this->element_line_3_enabled = true;
                    $this->element_line_3_placeholder = $c2element->default_text;
                } elseif (Str::lower($c2element->name) == 'map coordinates') {
                    $this->element_map_coordinates_enabled = true;
                } else {
                    $this->status_message = 'template element ' . $c2element->name . ' is undefined.';
                    $this->message_type = 'error';
                    $this->show_message = true;
                    $this->preview_valid = false;
                }
            }
            if ($this->preview_valid) {
                if (count($this->local_template->c2elements) == 0) {
                    $this->render_it_enabled = true;
                    $this->select_it_enabled = false;
                } else {
                    $this->personalize_it_enabled = true;
                    $this->select_it_enabled = false;
                }
            }
        } else {
            $this->status_message = "Invalid SKU.";
            $this->message_type = 'error';
            $this->show_message = true;
            $this->preview_valid = false;
        }
    }
    /*
    public function sql_get_template()
    {
        $result = true;
        $sql_template_result = DB::connection('sqlsrv')->table('templates')->select('templateid', 'name', 'code', 'filename')->where('Name', $this->template_name)->first();
        if ($sql_template_result) {
            $this->template_code = $sql_template_result->code;
            $sql_elements_result = DB::connection('sqlsrv')->table('templateelements')->select('templateelementid', 'text', 'elementname', 'isText')->where('templateid', $sql_template_result->templateid)->get();
            $collection = collect([]);
            foreach ($sql_elements_result as $template_element) {
                $collection = $collection->concat([$template_element->elementname]);
            }
            $this->template_elements = $collection;
        } else {
            $this->status_message = "Invalid SKU.";
            $this->message_type = 'error';
            $this->show_message = true;
            $this->preview_valid = false;
            $result = false;
        }
        return $result;
    }
    */

    public function personalize_it()
    {
        // generate personilication string
        //Personalizations[0].ElementName=LINE%201&Personalizations[0].Text=Dalton&Personalizations[0].IsText=true
        //replace ands str_replace('&', '%26', $text);
        $this->status_message = '';
        $this->show_message = false;
        $this->preview_valid = true;
        $this->render_is_set = false;
        $this->personalization_string = '';
        $index = 0;
        foreach ($this->local_template->c2elements as $c2element) {
            if (strtolower($c2element->name) == 'line 1') {
                $this->personalization_string = $this->personalization_string . '&Personalizations[' . $index . '].ElementName=' . str_replace('&', '%26', $c2element->name) . '&Personalizations[' . $index . '].Text=' . str_replace('&', '%26', trim($this->element_line_1)) . '&Personalizations[' . $index . '].IsText=true';
            } elseif (strtolower($c2element->name) == 'line 2') {
                $this->personalization_string = $this->personalization_string . '&Personalizations[' . $index . '].ElementName=' . str_replace('&', '%26', $c2element->name) . '&Personalizations[' . $index . '].Text=' . str_replace('&', '%26', trim($this->element_line_2)) . '&Personalizations[' . $index . '].IsText=true';
            } elseif (strtolower($c2element->name) == 'line 3') {
                $this->personalization_string = $this->personalization_string . '&Personalizations[' . $index . '].ElementName=' . str_replace('&', '%26', $c2element->name) . '&Personalizations[' . $index . '].Text=' . str_replace('&', '%26', trim($this->element_line_3)) . '&Personalizations[' . $index . '].IsText=true';
            } elseif (strtolower($c2element->name) == 'map coordinates') {
                $this->personalization_string = $this->personalization_string . '&Personalizations[' . $index . '].ElementName=' . str_replace('&', '%26', $c2element->name) . '&Personalizations[' . $index . '].Text=' . str_replace('&', '%26', trim($this->element_map_coordinates)) . '&Personalizations[' . $index . '].IsText=true';
            } elseif (strtolower($c2element->name) == 'mascot') {
                if ($this->element_map_coordinates_enabled) {
                    $this->personalization_string =  $this->personalization_string . '&Personalizations[' . $index . '].ElementName=' . str_replace('&', '%26', $c2element->name) . '&Personalizations[' . $index . '].Text=' . '' . '&Personalizations[' . $index . '].IsText=false';
                } elseif (($this->element_mascot == '-1') or (strlen($this->element_mascot) == 0)) {
                    $this->status_message = 'No mascot selected.';
                    $this->message_type = 'error';
                    $this->show_message = true;
                    $this->preview_valid = false;
                } else {
                    $this->personalization_string =  $this->personalization_string . '&Personalizations[' . $index . '].ElementName=' . str_replace('&', '%26', $c2element->name) . '&Personalizations[' . $index . '].Text=' . str_replace('&', '%26', trim($this->element_mascot)) . '&Personalizations[' . $index . '].IsText=false';
                }
            }
            $index++;
        }
        if ($this->preview_valid) {
            $this->render_it_enabled = true;
            $this->render_is_set = false;
            $this->build_customization_string();
            $this->render_it();
        } else {
            $this->render_it_enabled = false;
        }
    }

    public function build_customization_string()
    {
        $this->customization_string = '';
        $customization_array = [];
        if (strtolower($this->query_source) == 'zoey') {
            $this->customization_string = $this->element_map_coordinates;
        } elseif (strtolower($this->query_source) == 'faire') {
            foreach ($this->local_template->c2elements as $c2element) {
                if (strtolower($c2element->name) == 'line 1') {
                    $customization_array = Arr::add($customization_array, $c2element->name, $this->element_line_1);
                } elseif (strtolower($c2element->name) == 'line 2') {
                    $customization_array = Arr::add($customization_array, $c2element->name, $this->element_line_2);
                } elseif (strtolower($c2element->name) == 'line 3') {
                    $customization_array = Arr::add($customization_array, $c2element->name, $this->element_line_3);
                } elseif (strtolower($c2element->name) == 'map coordinates') {
                    $customization_array = Arr::add($customization_array, $c2element->name, $this->element_map_coordinates);
                } elseif (strtolower($c2element->name) == 'mascot') {
                    $customization_array = Arr::add($customization_array, $c2element->name, $this->element_mascot);
                }
            }
            $this->customization_string = json_encode($customization_array);
        } elseif (strtolower($this->query_source) == 'pgd') {
            foreach ($this->local_template->c2elements as $c2element) {
                if (strtolower($c2element->name) == 'line 1') {
                    $customization_array = Arr::add($customization_array, $c2element->name, $this->element_line_1);
                } elseif (strtolower($c2element->name) == 'line 2') {
                    $customization_array = Arr::add($customization_array, $c2element->name, $this->element_line_2);
                } elseif (strtolower($c2element->name) == 'line 3') {
                    $customization_array = Arr::add($customization_array, $c2element->name, $this->element_line_3);
                } elseif (strtolower($c2element->name) == 'map coordinates') {
                    $customization_array = Arr::add($customization_array, $c2element->name, $this->element_map_coordinates);
                } elseif (strtolower($c2element->name) == 'mascot') {
                    $customization_array = Arr::add($customization_array, $c2element->name, $this->element_mascot);
                }
            }
            $this->customization_string = json_encode($customization_array);
        }
    }

    public function render_it()
    {
        $this->status_message = '';
        $this->show_message = false;
        //$this->get_map();
        $code = $this->local_template->code;
        $response_order = Http::timeout(60)->withHeaders(['apiKey' => config('app.pulse_key')])->get(config('app.pulse_endpoint') . "/api/Orders/Render?OrderType=print-template&Product1&TemplateCode=$code$this->personalization_string");
        $this->local_file_name =  substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 7);
        //Storage::disk('local')->put('/public/C2/' . $this->template_name . '/' . $this->local_file_name . '.png', $response_order->body());
        Storage::disk('local')->put('/public/C2/' . $this->local_file_name . '.png', $response_order->body());
        if (filesize(storage_path("/app/public/C2/$this->local_file_name" . '.png')) < 200) {
            $this->render_is_available = false;
            //Storage::disk('local')->copy('NoRender.png', '/public/C2/' . $this->local_file_name . '.png');
        }
        Design::Create(['filename' => $this->local_file_name . '.png']);

        if ($this->preview_valid) {
            $this->download_it_enabled = true;
            if ($this->query_source) {
                $this->copy_it_enabled = true;
            }
            $this->submit_it_enabled = true;
            $this->download_file_name = strtoupper($this->template_name);
        } else {
            $this->download_it_enabled = false;
        }
        $this->render_is_set = true;
        //redirect(route('pulse.preview'));
    }

    public function get_map()
    {
        // 1) get map
        // 2) convert to RGB?
        // 3) Add wood background for certain templates
        // 4) resizing

        $username = 'tonycmf';
        $access_token = 'pk.eyJ1IjoidG9ueWNtZiIsImEiOiJjbGdvMnAwNDkwbGxvM3RsdTFlajJkbWN2In0.P2934jiPU233bNahCAeS_w';

        $template = $this->template_name;
        //$coordinates = '12.09,32.186990,-80.748317';
        $coordinates = $this->element_map_coordinates;

        $coordinates_array = explode(',', $coordinates);

        $Blue = ["C2COA2046", "C2HFA0056", "C2BFW0001", "C2BFW0002"];
        $Teal = ["C2BFW0009", "C2BFW0011", "C2HFA0063", "C2COA2095"];
        $Grey = ["C2BFW0008", "C2BFW0010", "C2BFW0012", "C2HFA0062", "C2BFW0007", "C2COA2094"];

        if (in_array($template, $Blue)) {
            $style = "clgnvdcc7006801qgcuyy8vf0";
            $Map = true;
        }
        if (in_array($template, $Teal)) {
            $style = "clmq4wp6304z301qxers706cf";
            $Map = false;
        }
        if (in_array($template, $Grey)) {
            $style = "clmq4z7b604vy01p99ywdgc1z";
            $Map = false;
        }

        $zoom_054 = ["C2BFW0012", "C2BFW0008"];
        if (in_array($template, $zoom_054)) {
            $coordinates_array[0] = $coordinates_array[0] - 0.54;
        }
        if ($template == "C2BFW0007") {
            $coordinates_array[0] = $coordinates_array[0] - 0.47;
        }
        if ($template == "C2BFW0010") {
            $coordinates_array[0] = $coordinates_array[0] - 0.57;
        }
        if ($template == "C2HFA0062") {
            $coordinates_array[0] = $coordinates_array[0] - 0.18;
        }
        $height = '1280';
        $width = '1280';
        $map_box_url = "https://api.mapbox.com/styles/v1/$username/$style/static/$coordinates_array[2],$coordinates_array[1],$coordinates_array[0],0/$height" . "x" . "$width@2x?logo=false&attribution=false&access_token=$access_token";
        $response_mapbox = Http::get($map_box_url);
        $this->local_file_name =  substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 7);
        Storage::disk('local')->put('/public/C2/' . $this->template_name . '/' . $this->local_file_name . '.png', $response_mapbox->body());
    }

    public function download_it()
    {
        //return response()->download(storage_path('app/public/C2/' . $this->template_name . '/' . $this->local_file_name . '.png'), str_replace(' ', '_', $this->download_file_name . '.png'));
        return response()->download(storage_path('app/public/C2/' . $this->local_file_name . '.png'), str_replace(' ', '_', $this->download_file_name . '.png'));
    }

    public function copy_it()
    {
        // code in java script
    }

    public function submit_it()
    {
        // get batch id 
        $counter = $this->increment_counter_prefix('Render');
        $this->pulse_batch_id = $counter;
        // order submit
        $code = $this->local_template->code;
        $response = Http::withHeaders(['apiKey' => config('app.pulse_key')])->post(config('app.pulse_endpoint') . "/api/Orders/Submit?OrderType=print-template&ProductCode=Product1&TemplateCode=$code&Job=$this->pulse_batch_id&$this->personalization_string");
        if ($response->status() == 200) {
            $status_message = 'Order submitted to Pulse.';
            $show_message = true;
            $message_type = 'success';
        } else {
            $status_message = 'Error submitted to Pulse. Status code = ' . $response->status();
            $show_message = true;
            $message_type = 'error';
            $preview_valid = false;
        }
        $this->submit_it_enabled = false;
    }

    public function reset_it()
    {
        redirect(route('preview'));
        //$this->reset_variables();
    }

    public function render()
    {
        return view('livewire.preview');
    }
}
