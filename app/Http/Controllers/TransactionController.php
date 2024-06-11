<?php

namespace App\Http\Controllers;

use App\Models\CreditTransaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function index()
    {
        $transactions = CreditTransaction::orderBy('payment_date', 'asc')->get()->all();
        return view('pages.transactions.index', compact('transactions'));
    }

    public function art()
    {
        $transactions = CreditTransaction::where('payment_description', 'like', '%APT%')->orWhere('payment_description', 'like', '%АПЗ%')
            ->orderBy('payment_date', 'asc')
            ->get();
        return view('pages.transactions.art', compact('transactions'));
    }

    public function ads()
    {
        $transactions = CreditTransaction::where('payment_description', 'like', '%ГОРОД ТАШКЕНТ%')
            ->orderBy('payment_date', 'asc')
            ->get();
        return view('pages.transactions.ads', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = CreditTransaction::find($id);
        return view('pages.transactions.show', compact('transaction'));
    }
}
