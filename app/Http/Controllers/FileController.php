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
    public function show($id) {
        $client = Client::with('products')->with('companies')->where('is_deleted', '!=', 1)->find($id);
        $client->yuridik_rekvizid;
        $client->contact;
        
        $branchDocuments = []; // Array to store generated documents
        
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
    
                // Generate document for each branch and store it in the array
                $headers = [
                    'Content-type' => 'text/html',
                    'Content-Disposition' => 'attachment; Filename='.$company->company_name.'_branch_'.$branch->id.'.doc'
                ];
    
                $branchDocument = view('pages.docs.full2', compact('client', 'company', 'branch'))->render();
                $branchDocuments[] = ['document' => $branchDocument, 'headers' => $headers];
            }
        }
    
        // Zip the documents
        $zip = new \ZipArchive();
        $zipFileName = storage_path('app/АПЗ_'. Carbon::now()->format('Y-m-d') .  '.zip');
        if ($zip->open($zipFileName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
            foreach ($branchDocuments as $branchDoc) {
                $zip->addFromString(basename($branchDoc['headers']['Content-Disposition']), $branchDoc['document']);
            }
            $zip->close();
        }
    
        // Download the zip file
        return response()->download($zipFileName)->deleteFileAfterSend(true);
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
