<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VersionNote;
use App\Models\VersionType;

class VersionNoteController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $version_notes = VersionNote::with('version_type')->with('version')->orderby('version_id','desc')->orderby('version_type_id')->get();
        return view('version', ['version_notes' => $version_notes]);
    }
}
