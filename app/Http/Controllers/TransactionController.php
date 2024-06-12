<?php

namespace App\Http\Controllers;

use App\Models\CreditTransaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = CreditTransaction::query();
        
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($query) use ($search) {
                $query->where('payer_inn', 'like', "%$search%")
                    ->orWhere('payer_mfo', 'like', "%$search%")
                    ->orWhere('payment_date', 'like', "%$search%")
                    ->orWhere('payer_account', 'like', "%$search%")
                    ->orWhere('document_number', 'like', "%$search%");
            });
        }
    
        $transactions = $query->orderBy('payment_date', 'desc')->paginate(20);
        
        $creditSum = CreditTransaction::sum('credit');
    
        return view('pages.transactions.index', compact('transactions', 'creditSum'));
    }
        
    
    public function art(Request $request)
    {
        $query = CreditTransaction::deepFilters()
            ->where(function ($query) {
                $query->where('payment_description', 'like', '%APT%')
                      ->orWhere('payment_description', 'like', '%АПЗ%');
            });

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($query) use ($search) {
                $query->where('payer_inn', 'like', "%$search%")
                    ->orWhere('payer_mfo', 'like', "%$search%")
                    ->orWhere('payment_date', 'like', "%$search%")
                    ->orWhere('payer_account', 'like', "%$search%")
                    ->orWhere('document_number', 'like', "%$search%");
            });
        }

        $transactions = $query->orderBy('payment_date', 'desc')->paginate(20);
        
        $creditSum = CreditTransaction::where('payment_description', 'like', '%APT%')
        ->orWhere('payment_description', 'like', '%АПЗ%')
        ->sum('credit');

        return view('pages.transactions.art', compact('transactions', 'creditSum'));
    }

    public function ads(Request $request)
    {
        $query = CreditTransaction::deepFilters()
            ->where('payment_description', 'like', '%ГОРОД ТАШКЕНТ%');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($query) use ($search) {
                $query->where('payer_inn', 'like', "%$search%")
                    ->orWhere('payer_mfo', 'like', "%$search%")
                    ->orWhere('payment_date', 'like', "%$search%")
                    ->orWhere('payer_account', 'like', "%$search%")
                    ->orWhere('document_number', 'like', "%$search%");
            });
        }

        $transactions = $query->orderBy('payment_date', 'desc')->paginate(20);
        
        $creditSum = CreditTransaction::where('payment_description', 'like', '%ГОРОД ТАШКЕНТ%')
        ->sum('credit');
    
        return view('pages.transactions.ads', compact('transactions','creditSum'));
    }

    public function show($id)
    {
        // Retrieve the transaction using Eloquent ORM
        $transaction = CreditTransaction::find($id);
        
        // Check if the transaction exists
        if (!$transaction) {
            abort(404, 'Transaction not found');
        }
    
        $payerUser = \DB::table('credit_transactions')
        ->join('clients', function ($join) {
            $join->on('clients.stir', 'like', \DB::raw("CONCAT('%', credit_transactions.payer_inn, '%')"));
        })
        ->join('branches', 'branches.client_id', '=', 'clients.id')
        ->select('credit_transactions.*', 'clients.*', 'branches.*')
        ->whereNotNull('credit_transactions.document_number')
        // ->where('credit_transactions', $id)
        ->get();
    
       
    
        
    
        // Debugging: Dump the payerUser object to verify the data
        dd($payerUser);
    
        return view('pages.transactions.show', compact('transaction', 'payerUser'));
    }
    
    

    // public function payers()
    // {
    //     $transactions = \DB::table('credit_transactions')
    //         ->join('clients', 'clients.stir', 'like', \DB::raw("CONCAT('%', credit_transactions.payer_inn, '%')"))
    //         ->select('credit_transactions.*', 'clients.*')
    //         ->paginate(20);
    
    //     return view('pages.transactions.payers', compact('transactions'));

    // }

    public function payers(Request $request)
    {
        $query = \DB::table('credit_transactions')
        ->join('clients', 'clients.stir', 'like', \DB::raw("CONCAT('%', credit_transactions.payer_inn, '%')"))
        ->join('branches', 'branches.client_id', '=', 'clients.id') // Adjust the join condition based on your schema
        ->select('credit_transactions.*', 'clients.*', 'branches.*')
        ->whereNotNull('credit_transactions.document_number'); // Exclude rows where document_number is null
    
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($query) use ($search) {
                $query->where('credit_transactions.payer_inn', 'like', "%$search%")
                    ->orWhere('credit_transactions.payer_mfo', 'like', "%$search%")
                    ->orWhere('credit_transactions.payment_date', 'like', "%$search%")
                    ->orWhere('credit_transactions.payer_account', 'like', "%$search%")
                    ->orWhere('clients.stir', 'like', "%$search%")
                    ->orWhere('clients.company_name', 'like', "%$search%")
                    ->orWhere('clients.contact', 'like', "%$search%")
                    ->orWhere('credit_transactions.document_number', 'like', "%$search%");
            });
        }
        
        $transactions = $query->orderBy('credit_transactions.payment_date', 'desc')->paginate(20);
    
        return view('pages.transactions.payers', compact('transactions'));
    }


    
}
