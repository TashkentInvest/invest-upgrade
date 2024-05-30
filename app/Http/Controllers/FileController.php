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

    // download word
    public function show($id){
    
        $client = Client::with('products')->with('companies')->where('is_deleted', '!=', 1)->find($id);
        $client->yuridik_rekvizid;
        $client->contact;
        foreach ($client->companies as $company) {
            $company->company_type;
            $company->company_location;
            $company->bank_code;
            $company->stir;
            $company->oked;
            $company->company_location;
            
            foreach ($company->branches as $branch) {
                $branch->generate_price;
                $branch->payment_type;
                $branch->branch_kubmetr;
    
                $headers = array(
                    'Content-type' => 'text/html',
                    'Content-Disposition'=>'attachment; Filename='.$company->company_name.'_branch_'.$branch->id.'.doc'
                );
    
                $branchDocument = view('pages.docs.full2', compact('client', 'company', 'branch'))->render();
    
                Response::make($branchDocument, 200, $headers)->send();
            }
        }
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
