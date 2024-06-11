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
    
        $transactions = $query->orderBy('payment_date', 'asc')->paginate(20);
        
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

        $transactions = $query->orderBy('payment_date', 'asc')->paginate(20);
        
        $creditSum = CreditTransaction::where('payment_description', 'like', '%APT%')
        ->orWhere('payment_description', 'like', '%АПЗ%')
        ->sum('credit');

        return view('pages.transactions.art', compact('transactions', 'creditSum'));
    }

    public function ads(Request $request)
    {
        // Initialize the query builder
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

        $transactions = $query->orderBy('payment_date', 'asc')->paginate(20);
        
        $creditSum = CreditTransaction::where('payment_description', 'like', '%ГОРОД ТАШКЕНТ%')
        ->sum('credit');
    
        return view('pages.transactions.ads', compact('transactions','creditSum'));
    }

    public function show($id)
    {
        // Eager load the transaction data
        $transaction = CreditTransaction::with('relatedData')->find($id);
        return view('pages.transactions.show', compact('transaction'));
    }
}
