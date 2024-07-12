<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Exports\ProductsExport;
use App\Models\Category;
use Carbon\Carbon;


class FileController extends Controller
{
    public function show($id)
    {
        // Fetch the client along with branches if not deleted
        $client = Client::with('branches')
            ->where('is_deleted', '!=', 1)
            ->find($id);

        if (!$client) {
            return response()->view('errors.custom', ['status' => 404, 'message' => 'Client Not Found'], 404);
        }

        $clientAttributes = [
            'yuridik_rekvizid',
            'contact',
            'branch_type',
            'company_location',
            'bank_code',
            'stir',
            'oked'
        ];

        foreach ($clientAttributes as $attribute) {
            $client->$attribute;
        }

        $branchDocuments = [];

        // Determine the views based on the client type and payment type
        $fizikBolibView = 'pages.docs.bolib_pay.fizik_litso';
        $fizikFullView = 'pages.docs.full_pay.fizik_litso';
        $yurikBolibView = 'pages.docs.bolib_pay.yurik_litso';
        $yurikFullView = 'pages.docs.full_pay.yurik_litso';

        // $passport_formattedDate = Carbon::parse($client->passport_date)->format('Y-m-d H:i:s');
        // $client->passport_serial;
        // $client->raxbar;
        // dd($client->passport_serial);

        foreach ($client->branches as $branch) {
            $branch->generate_price;
            $branch->branch_kubmetr;
            $branch->branch_type;
            $branch->branch_location;

            // Ensure valid filenames with identifiers
            $fizikBolibFilename = 'fizik_bolib_' . preg_replace('/[<>:"\/\\|?*]+/', '_', $client->company_name . '_branch_' . $branch->id . '_name_' . $branch->contract_apt . '.doc');
            $fizikFullFilename = 'fizik_full_' . preg_replace('/[<>:"\/\\|?*]+/', '_', $client->company_name . '_branch_' . $branch->id . '_name_' . $branch->contract_apt . '.doc');
            $yurikBolibFilename = 'yurik_bolib_' . preg_replace('/[<>:"\/\\|?*]+/', '_', $client->company_name . '_branch_' . $branch->id . '_name_' . $branch->contract_apt . '.doc');
            $yurikFullFilename = 'yurik_full_' . preg_replace('/[<>:"\/\\|?*]+/', '_', $client->company_name . '_branch_' . $branch->id . '_name_' . $branch->contract_apt . '.doc');

            // Render documents for each branch and add them to the branchDocuments array
            $branchDocuments[] = ['document' => view($fizikBolibView, compact('client', 'branch'))->render(), 'filename' => $fizikBolibFilename];
            $branchDocuments[] = ['document' => view($fizikFullView, compact('client', 'branch'))->render(), 'filename' => $fizikFullFilename];
            $branchDocuments[] = ['document' => view($yurikBolibView, compact('client', 'branch'))->render(), 'filename' => $yurikBolibFilename];
            $branchDocuments[] = ['document' => view($yurikFullView, compact('client', 'branch'))->render(), 'filename' => $yurikFullFilename];
        }


        $zip = new \ZipArchive();
        $zipFileName = storage_path('app/АПЗ_' . \Carbon\Carbon::now()->format('Y-m-d') . '.zip');

        if ($zip->open($zipFileName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
            // Log error if zip file cannot be opened
            \Log::error('Cannot create zip file at ' . $zipFileName);
            return response()->view('errors.custom', ['status' => 500, 'message' => 'Cannot create zip file'], 500);
        }

        foreach ($branchDocuments as $branchDoc) {
            $zip->addFromString($branchDoc['filename'], $branchDoc['document']);
        }
        $zip->close();

        return response()->download($zipFileName)->deleteFileAfterSend(true);
    }

    

    public function downloadFullTableData($startDate = null, $endDate = null)
    {
        $fileName = 'АПЗ_РАҚАМ' . '_' . now()->format('Y-m-d') . '.xls';

        return Excel::download(new ProductsExport(null, $startDate, $endDate), $fileName);
    }
    public function downloadTableData($id, $startDate = null, $endDate = null)
    {
        $fileName = 'АПЗ_РАҚАМ' . '_' . now()->format('Y-m-d') . '.xls';

        return Excel::download(new ProductsExport($id, $startDate, $endDate), $fileName);
    }
    public function downloadExcel(Request $request)
    {
        $columns = $request->input('columns', []);

        return Excel::download(new ProductsExport(null, null, null, $columns), 'products.xlsx');
    }
    public function showColumnSelectionForm()
    {
        return view('pages.exel.select_columns');
    }

    public function dop($id)
    {
        $client = Client::with('branches')
            ->where('is_deleted', '!=', 1)
            ->find($id);


        foreach ($client->branches as $branch) {
            $branch->generate_price;
            $branch->branch_kubmetr;
            $branch->branch_type;
            $branch->branch_location;
        }
        return view('pages.docs.dop_saglashenya', compact('client', 'branch'));
    }


    public function gerb($id){
        $headers = array(
            'Content-type' => 'text/html',
            'Content-Disposition'=>'attachement; Filename=mydoc.doc'
        );
    
        $client = Client::where('id', $id)
        ->with(['company', 'branches', 'address', 'passport'])
        ->first();

        
    
        return Response::make(view('pages.docs.mobile', compact('client')), 200, $headers);
    }
    // public function gerb($id){
    //       $client = Client::where('id', $id)
    //     ->with(['company', 'branches', 'address', 'passport'])
    //     ->first();
        
    
    //     return view('pages.docs.mobile', compact('client'));
    // }

}
