<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ConstructionController extends Controller
{
    public function index(){
        $constructions = Client::deepFilters()->with(['branches', 'files'])->where('is_deleted', '!=', 1)->orderBy('id', 'desc')
        ->paginate(25);
        
        return view('pages.construction.tasks.index', compact('constructions'));
    }

    public function show($id){
        
        $construction = Client::find($id);
        return view('pages.construction.tasks.show', compact('construction'));

    }
}
