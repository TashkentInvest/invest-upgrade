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
        $client = Client::with('products')->with('branches')->where('is_deleted', '!=', 1)->find($id);
        if($client->mijoz_turi == 'fizik'){
            return view('pages.docs.fizik_litso', compact('client'));
        }else{
            return view('pages.docs.full_pay.yurik_litso', compact('client'));
        }
    }
    // download word

    public function show($id)
    {
        $client = Client::with('products')->with('branches')->where('is_deleted', '!=', 1)->find($id);
        $client->yuridik_rekvizid;
        $client->contact;
        $client->company_type;
        $client->company_location;
        $client->bank_code;
        $client->stir;
        $client->oked;
        $client->company_location;

        

        $branchDocuments = []; 

        

        if($client->mijoz_turi == 'fizik'){
            foreach ($client->branches as $branch) {
                $branch->generate_price;
                // $branch->payment_type;
                $branch->branch_kubmetr;

                // Generate document for each branch and store it in the array
                $headers = [
                    'Content-type' => 'text/html',
                    'Content-Disposition' => 'attachment; Filename=' . $client->company_name . '_branch_' . $branch->id . '.doc'
                ];

                $branchDocument = view('pages.docs.bolib_pay.fizik_litso', compact('client', 'branch'))->render();
                $branchDocuments[] = ['document' => $branchDocument, 'headers' => $headers];
            }
        }else{
            foreach ($client->branches as $branch) {
                $branch->generate_price;
                // $branch->payment_type;
                $branch->branch_kubmetr;

                // Generate document for each branch and store it in the array
                $headers = [
                    'Content-type' => 'text/html',
                    'Content-Disposition' => 'attachment; Filename=' . $client->company_name . '_branch_' . $branch->id . '.doc'
                ];

                $branchDocument = view('pages.docs.full_pay.yurik_litso', compact('client', 'branch'))->render();
                $branchDocuments[] = ['document' => $branchDocument, 'headers' => $headers];
            }
        }
        

        // Zip the documents
        $zip = new \ZipArchive();
        $zipFileName = storage_path('app/АПЗ_' . Carbon::now()->format('Y-m-d') .  '.zip');
        if ($zip->open($zipFileName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
            foreach ($branchDocuments as $branchDoc) {
                $zip->addFromString(basename($branchDoc['headers']['Content-Disposition']), $branchDoc['document']);
            }
            $zip->close();
        }

        // Download the zip file
        return response()->download($zipFileName)->deleteFileAfterSend(true);
    }
    public function show_org($id)
    {
        $client = Client::with('products')->with('companies')->where('is_deleted', '!=', 1)->find($id);
        $client->yuridik_rekvizid;
        $client->contact;
        $client->company_type;
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

                // Generate document for each branch and store it in the array
                $headers = [
                    'Content-type' => 'text/html',
                    'Content-Disposition' => 'attachment; Filename=' . $client->company_name . '_branch_' . $branch->id . '.doc'
                ];

                $branchDocument = view('pages.docs.full2', compact('client', 'company', 'branch'))->render();
                $branchDocuments[] = ['document' => $branchDocument, 'headers' => $headers];
            }
        

        // Zip the documents
        $zip = new \ZipArchive();
        $zipFileName = storage_path('app/АПЗ_' . Carbon::now()->format('Y-m-d') .  '.zip');
        if ($zip->open($zipFileName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
            foreach ($branchDocuments as $branchDoc) {
                $zip->addFromString(basename($branchDoc['headers']['Content-Disposition']), $branchDoc['document']);
            }
            $zip->close();
        }

        // Download the zip file
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
