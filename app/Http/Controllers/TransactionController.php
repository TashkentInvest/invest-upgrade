<?php

namespace App\Http\Controllers;

use App\Models\CreditTransaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function index(){
        $transactions = CreditTransaction::orderBy('payment_date', 'asc')->get()->all();
        return view('pages.transactions.index',compact('transactions'));
    }

    public function show($id){
        $transaction = CreditTransaction::find($id);
        return view('pages.transactions.show',compact('transaction'));
    }
    public function debat(){

    }
    public function credit(){

    }
}
