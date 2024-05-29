<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class FileController extends Controller
{

    public function index(){
        $headers = array(
            'Content-type' => 'text/html',
            'Content-Disposition'=>'attachement; Filename=mydoc.doc'
        );

       
    
        $clients = Client::with('products')->with('companies')->where('is_deleted', '!=', 1)->get()->all();
        if(count($clients) >=0)
            return Response::make(view('pages.docs.full2', compact('clients')), 200, $headers);
        else{
            return redirect()->back();
            
        }
    }
    
}
