<?php

namespace App\Http\Controllers;

use App\Models\CreditTransaction;
use App\Models\DebetTransaction;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Shuchkin\SimpleXLSX;

class ImportController extends Controller
{
    public function index()
    {
        return view('pages.import.import2');
    }

    // public function import(Request $request)
    // {
    //     // Handle file upload and other data processing
    //     $debetFile = $request->file('debet_file');
    //     $creditFile = $request->file('credit_file');

    //     // Import data from Debet file
    //     if ($debetFile) {
    //         $debetPath = $debetFile->getRealPath();
    //         if ($xlsx = SimpleXLSX::parse($debetPath)) {
    //             $rows = $xlsx->rows();
    //             foreach ($rows as $key => $row) {
    //                 if ($key === 0) {
    //                     continue; // Skip header row
    //                 }

    //                 DebetTransaction::create([
    //                     'document_number' => preg_replace('/\D/', '', $row[0] ?? ''),
    //                     'operation_code' => $row[1] ?? null,
    //                     'payer_name' => $row[2] ?? null,
    //                     'payer_inn' => $row[3] ?? null,
    //                     'payer_mfo' => $row[4] ?? null,
    //                     'payer_account' => $row[5] ?? null,
    //                     'payment_date' => isset($row[6]) ? date('Y-m-d', strtotime($row[6])) : null,
    //                     'operation_day' => isset($row[7]) ? date('Y-m-d', strtotime($row[7])) : null,
    //                     'payment_description' => $row[8] ?? null,
    //                     'debit' => isset($row[9]) ? (float) str_replace(',', '', $row[9]) : 0,
    //                     'credit' => isset($row[10]) ? (float) str_replace(',', '', $row[10]) : 0,
    //                     'recipient_name' => $row[11] ?? null,
    //                     'recipient_inn' => $row[12] ?? null,
    //                     'recipient_mfo' => $row[13] ?? null,
    //                     'recipient_bank' => $row[14] ?? null,
    //                     'recipient_account' => $row[15] ?? null,
    //                 ]);
    //             }

    //             return back()->with('success', 'Debet data imported successfully.');
    //         } else {
    //             return back()->with('error', 'Error parsing Debet file.');
    //         }
    //     }

    //     // Import data from Credit file
    //     if ($creditFile) {
    //         $creditPath = $creditFile->getRealPath();
    //         if ($xlsx = SimpleXLSX::parse($creditPath)) {
    //             $rows = $xlsx->rows();
    //             foreach ($rows as $key => $row) {
    //                 if ($key === 0) {
    //                     continue; // Skip header row
    //                 }

    //                 CreditTransaction::create([
    //                     'document_number' => preg_replace('/\D/', '', $row[0] ?? ''),
    //                     'operation_code' => $row[1] ?? null,
    //                     'recipient_name' => $row[2] ?? null,
    //                     'recipient_inn' => $row[3] ?? null,
    //                     'recipient_mfo' => $row[4] ?? null,
    //                     'recipient_account' => $row[5] ?? null,
    //                     'payment_date' => isset($row[6]) ? date('Y-m-d', strtotime($row[6])) : null,
    //                     'payment_description' => $row[7] ?? null,
    //                     'debit' => isset($row[8]) ? (float) str_replace(',', '', $row[8]) : 0,
    //                     'credit' => isset($row[9]) ? (float) str_replace(',', '', $row[9]) : 0,
    //                     'payer_name' => $row[10] ?? null,
    //                     'payer_inn' => $row[11] ?? null,
    //                     'payer_mfo' => $row[12] ?? null,
    //                     'payer_bank' => $row[13] ?? null,
    //                     'payer_account' => $row[14] ?? null,
    //                 ]);
    //             }

    //             return back()->with('success', 'Credit data imported successfully.');
    //         } else {
    //             return back()->with('error', 'Error parsing Credit file.');
    //         }
    //     }

    //     // If neither Debet nor Credit file is uploaded
    //     return back()->with('error', 'No file uploaded.');
    // }

    public function import_debat(Request $request)
    {


        $path = $request->file('debat_excel_file')->getRealPath();


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
            //         'debit' => isset($row[8]) ? (float) str_replace(',', '', $row[8]) : 0, // Remove commas
            //         'credit' => isset($row[9]) ? (float) str_replace(',', '', $row[9]) : 0, // Remove commas
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


    public function import_credit(Request $request)
    {
        $path = $request->file('credit_excel_file')->getRealPath();

        if ($xlsx = SimpleXLSX::parse($path)) {
            $rows = $xlsx->rows(0);

            foreach ($rows as $key => $row) {
                if ($key === 0) {
                    continue; // Skip the header row
                }

                // Preprocess and sanitize data before insertion
                $rowData = [
                    'document_number' => $row[1] ?? null,
                    'operation_code' => $row[2] ?? null,
                    'recipient_name' => $row[3] ?? null,
                    'recipient_inn' => $row[4] ?? null,
                    'recipient_mfo' => $row[5] ?? null,
                    'recipient_account' => $row[6] ?? null,
                    'payment_date' => isset($row[7]) ? date('Y-m-d', strtotime($row[7])) : null,
                    'payment_description' => $row[8] ?? null,
                    'debit' => isset($row[9]) ? (float) str_replace(',', '', $row[9]) : 0, // Remove commas
                    'credit' => isset($row[10]) ? (float) str_replace(',', '', $row[10]) : 0, // Remove commas
                    'payer_name' => $row[11] ?? null,
                    'payer_inn' => $row[12] ?? null,
                    'payer_mfo' => $row[13] ?? null,
                    'payer_bank' => $row[14] ?? null,
                    'payer_account' => $row[15] ?? null,
                ];

                // Update existing record or create a new one if it doesn't exist
                $creditTransaction = CreditTransaction::updateOrCreate(
                    ['document_number' => $rowData['document_number']], // unique identifier to find the record
                    $rowData
                );

                // Prepare transaction data
                $transactionData = [
                    'credit_transaction_id' => $creditTransaction->id, // Ensure this field exists in the transactions table
                    'name' => $request->get('name'),
                    'description' => $request->get('description'),
                    'father_name' => $request->get('father_name'),
                    'start_date' => $request->get('start_date'),
                    'end_date' => $request->get('end_date'),
                ];

                // Update existing transaction or create a new one if it doesn't exist
                $transaction = Transaction::updateOrCreate(
                    ['credit_transaction_id' => $creditTransaction->id], // unique identifier to find the record
                    $transactionData
                );
            }

            return back()->with('success', 'Data imported successfully.');
        } else {
            return back()->with('error', SimpleXLSX::parseError());
        }
    }

}
