<?php

namespace App\Livewire;

use App\Models\Design;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Dashboard extends Component
{
    public function clean_previews()
    {
        $clean_date = Carbon::today();
        $designs = Design::where('created_at','<', $clean_date)->get();
        foreach($designs as $design)
        {
            Storage::disk('local')->delete('/public/C2/' . $design->filename);
        }
        $deleted = DB::table('designs')->where('created_at','<', $clean_date)->delete();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
