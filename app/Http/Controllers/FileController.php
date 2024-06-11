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

    public function test($id){
        $client = Client::with('branches')->where('is_deleted', '!=', 1)->find($id);
        return view('pages.docs.bolib_pay.yurik_litso', compact('client'));
    }
    public function show($id)
    {
        // Fetch the client along with branches if not deleted
        $client = Client::with('branches')
            ->where('is_deleted', '!=', 1)
            ->find($id);
    
        if (!$client) {
            return response()->view('errors.custom', ['status' => 404, 'message' => 'Client Not Found'], 404);
        }
    
        // Preload necessary client attributes
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
    
        $passport_formattedDate = Carbon::parse($client->passport_date)->format('Y-m-d H:i:s');
    
        foreach ($client->branches as $branch) {
            $branch->generate_price;
            $branch->branch_kubmetr;
            $branch->branch_type;
            $branch->branch_location;
        
            // Ensure valid filenames with identifiers
            $fizikBolibFilename = 'fizik_bolib_' . preg_replace('/[<>:"\/\\|?*]+/', '_', $client->company_name . '_branch_' . $branch->id . '.doc');
            $fizikFullFilename = 'fizik_full_' . preg_replace('/[<>:"\/\\|?*]+/', '_', $client->company_name . '_branch_' . $branch->id . '.doc');
            $yurikBolibFilename = 'yurik_bolib_' . preg_replace('/[<>:"\/\\|?*]+/', '_', $client->company_name . '_branch_' . $branch->id . '.doc');
            $yurikFullFilename = 'yurik_full_' . preg_replace('/[<>:"\/\\|?*]+/', '_', $client->company_name . '_branch_' . $branch->id . '.doc');
        
            // Render documents for each branch and add them to the branchDocuments array
            $branchDocuments[] = ['document' => view($fizikBolibView, compact('client', 'branch', 'passport_formattedDate'))->render(), 'filename' => $fizikBolibFilename];
            $branchDocuments[] = ['document' => view($fizikFullView, compact('client', 'branch', 'passport_formattedDate'))->render(), 'filename' => $fizikFullFilename];
            $branchDocuments[] = ['document' => view($yurikBolibView, compact('client', 'branch', 'passport_formattedDate'))->render(), 'filename' => $yurikBolibFilename];
            $branchDocuments[] = ['document' => view($yurikFullView, compact('client', 'branch', 'passport_formattedDate'))->render(), 'filename' => $yurikFullFilename];
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
    public function show_org($id)
    {
        $client = Client::with('companies')->where('is_deleted', '!=', 1)->find($id);
        $client->yuridik_rekvizid;
        $client->contact;
        $client->branch_type;
        $client->company_location;
        $client->bank_code;
        $client->stir;
        $client->oked;
        $client->company_location;

        $branchDocuments = []; 

            foreach ($client->branches as $branch) {
                $branch->generate_price;
                $branch->payment_type;
                $branch->branch_kubmetr;

                $headers = [
                    'Content-type' => 'text/html',
                    'Content-Disposition' => 'attachment; Filename=' . $client->company_name . '_branch_' . $branch->id . '.doc'
                ];

                $branchDocument = view('pages.docs.full2', compact('client', 'company', 'branch'))->render();
                $branchDocuments[] = ['document' => $branchDocument, 'headers' => $headers];
            }
        
        $zip = new \ZipArchive();
        $zipFileName = storage_path('app/АПЗ_' . Carbon::now()->format('Y-m-d') .  '.zip');
        if ($zip->open($zipFileName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
            foreach ($branchDocuments as $branchDoc) {
                $zip->addFromString(basename($branchDoc['headers']['Content-Disposition']), $branchDoc['document']);
            }
            $zip->close();
        }

        return response()->download($zipFileName)->deleteFileAfterSend(true);
    }
    public function downloadExcel(Request $request)
    {
        $id = $request->input('id');
        $startDate = $request->input('created_at');
        $endDate = $request->input('created_at_pair');

        if ($id) {
            return $this->downloadTableData($id, $startDate, $endDate);
        } else {
            return $this->downloadFullTableData($startDate, $endDate);
        }
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
}
