<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Exports\ProductsExport;
use Carbon\Carbon;


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
    

    // donwnload exel
    public function downloadTableData($id)
    {
        $client = Client::find($id);

        // $fileName = 'products_data_' . $client->first_name . '_' . $client->last_name . '_' . Carbon::now()->format('Y-m-d') . '.xls';

        $fileName = 'АПЗ_РАҚАМ' . '_' . Carbon::now()->format('Y-m-d') . '.xls';
        

        return Excel::download(new ProductsExport($id), $fileName);
    }
}
