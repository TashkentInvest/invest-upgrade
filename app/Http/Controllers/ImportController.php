<?php
namespace App\Http\Controllers;

use App\Models\CreditTransaction;
use App\Models\DebetTransaction;
use Illuminate\Http\Request;
use Shuchkin\SimpleXLSX;

class ImportController extends Controller
{
    public function index()
    {
        return view('pages.import.import');
    }

    public function import(Request $request)
    {


        $path = $request->file('excel_file')->getRealPath();
        
        
        if ($xlsx = SimpleXLSX::parse($path)) {
            // dd($xlsx);
            $sheets = $xlsx->sheetNames();

            $rows = $xlsx->rows(0);
            foreach ($rows as $key => $row) {
                if ($key === 0) {
                    continue;
                }
                DebetTransaction::create([
                    'document_number' => $row[0] ?? null,
                    'operation_code' => $row[1] ?? null,
                    'payer_name' => $row[2] ?? null,
                    'payer_inn' => $row[3] ?? null,
                    'payer_mfo' => $row[4] ?? null,
                    'payer_account' => $row[5] ?? null,
                    'payment_date' => isset($row[6]) ? date('Y-m-d', strtotime($row[6])) : null,
                    'operation_day' => isset($row[7]) ? date('Y-m-d', strtotime($row[7])) : null,
                    'payment_description' => $row[8] ?? null,
                    'debit' => isset($row[9]) ? (float)str_replace(',', '', $row[9]) : 0,
                    'credit' => isset($row[10]) ? (float)str_replace(',', '', $row[10]) : 0,
                    'recipient_name' => $row[11] ?? null,
                    'recipient_inn' => $row[12] ?? null,
                    'recipient_mfo' => $row[13] ?? null,
                    'recipient_bank' => $row[14] ?? null,
                    'recipient_account' => $row[15] ?? null,
                ]);
            }

            // Process the second sheet for credit transactions
            // $rows = $xlsx->rows(1);
            // foreach ($rows as $key => $row) {
            //     if ($key === 0) {
            //         continue; // Skip the header row
            //     }
            //     CreditTransaction::create([
            //         'document_number' => $row[0] ?? null,
            //         'operation_code' => $row[1] ?? null,
            //         'recipient_name' => $row[2] ?? null,
            //         'recipient_inn' => $row[3] ?? null,
            //         'recipient_mfo' => $row[4] ?? null,
            //         'recipient_account' => $row[5] ?? null,
            //         'payment_date' => isset($row[6]) ? date('Y-m-d', strtotime($row[6])) : null,
            //         'payment_description' => $row[7] ?? null,
            //         'debit' => isset($row[8]) ? (float)str_replace(',', '', $row[8]) : 0,
            //         'credit' => isset($row[9]) ? (float)str_replace(',', '', $row[9]) : 0,
            //         'payer_name' => $row[10] ?? null,
            //         'payer_inn' => $row[11] ?? null,
            //         'payer_mfo' => $row[12] ?? null,
            //         'payer_bank' => $row[13] ?? null,
            //         'payer_account' => $row[14] ?? null,
            //     ]);
            // }

            return back()->with('success', 'Data imported successfully.');
        } else {
            return back()->with('error', SimpleXLSX::parseError());
        }
    }
}
