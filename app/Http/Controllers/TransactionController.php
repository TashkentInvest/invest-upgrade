<?php

namespace App\Http\Controllers;

use App\Models\CreditTransaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function index()
    {
        $transactions = CreditTransaction::deepFilters()->orderBy('payment_date', 'asc')->get();
        $creditSum = CreditTransaction::sum('credit');
    
        return view('pages.transactions.index', compact('transactions', 'creditSum'));
    }
    

    public function art()
    {
        $transactions = CreditTransaction::deepFilters()
            ->where('payment_description', 'like', '%APT%')
            ->orWhere('payment_description', 'like', '%АПЗ%')
            ->orderBy('payment_date', 'asc')
            ->get();    
        
        $creditSum = CreditTransaction::where('payment_description', 'like', '%APT%')
            ->orWhere('payment_description', 'like', '%АПЗ%')
            ->sum('credit');
    
        return view('pages.transactions.art', compact('transactions', 'creditSum'));
    }
    
    
    public function ads()
    {
        $transactions = CreditTransaction::deepFilters()->where('payment_description', 'like', '%ГОРОД ТАШКЕНТ%')
            ->orderBy('payment_date', 'asc')
            ->get();

        $creditSum = CreditTransaction::where('payment_description', 'like', '%ГОРОД ТАШКЕНТ%')->sum('credit');
        return view('pages.transactions.ads', compact('transactions','creditSum'));
    }

    public function show($id)
    {
        $transaction = CreditTransaction::find($id);
        return view('pages.transactions.show', compact('transaction'));
    }
}
