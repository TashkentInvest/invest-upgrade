<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Response;

class FileController extends Controller
{

    public function index(){
        $headers = array(
            'Content-type' => 'text/html',
            'Content-Disposition'=>'attachement; Filename=mydoc.doc'
        );
    
        $data = [1,2,34];
    
        return Response::make(view('pages.index1', compact('data')), 200, $headers);
    }
    
}
