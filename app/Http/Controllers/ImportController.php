<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Shuchkin\SimpleXLS;

class ImportController extends Controller
{
    public function index(){
        return view('pages.import.import');
    }
    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xls,xlsx'
        ]);

        $path = $request->file('excel_file')->getRealPath();

        if ($xls = SimpleXLS::parse($path)) {
            $rows = $xls->rows();
            foreach ($rows as $key => $row) {
                if ($key === 0) {
                    continue; // Skip the header row
                }
                Transaction::create([
                    'document_number' => $row[0],
                    'operation_code' => $row[1],
                    'payer_name' => $row[2],
                    'payer_inn' => $row[3],
                    'payer_mfo' => $row[4],
                    'payer_account' => $row[5],
                    'payment_date' => date('Y-m-d', strtotime($row[6])),
                    'operation_day' => date('Y-m-d', strtotime($row[7])),
                    'payment_description' => $row[8],
                    'debit' => $row[9],
                    'credit' => $row[10],
                    'recipient_name' => $row[11],
                    'recipient_inn' => $row[12],
                    'recipient_mfo' => $row[13],
                    'recipient_bank' => $row[14],
                    'recipient_account' => $row[15],
                ]);
            }
            return back()->with('success', 'Data imported successfully.');
        } else {
            return back()->with('error', SimpleXLS::parseError());
        }
    }
}
