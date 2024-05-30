<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class FileController extends Controller
{

    public function show($id){
        $headers = array(
            'Content-type' => 'text/html',
            'Content-Disposition'=>'attachement; Filename=mydoc.doc'
        );

    
        $client = Client::with('products')->with('companies')->where('is_deleted', '!=', 1)->find($id);
        return Response::make(view('pages.docs.full2', compact('client')), 200, $headers);
      
    }
    
}
