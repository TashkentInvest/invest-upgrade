<?php

namespace App\Http\Controllers;

use App\Models\CreditTransaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function index(){
        $transactions = CreditTransaction::get()->all();
        return view('pages.transactions.index',compact('transactions'));
    }
    public function debat(){

    }
    public function credit(){

    }
}
