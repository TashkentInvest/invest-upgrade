<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Venturecraft\Revisionable\Revision;
use App\Models\Client;
use App\Models\Company;
use App\Models\Branch;
use App\Models\Payment;
use App\Models\Address;
use App\Models\Passport;

class RevisionController extends Controller
{
    // public function index()
    // {
    //     // Fetch revisions for each model
    //     $clientRevisions = Client::with('revisionHistory')->get();
    //     $companyRevisions = Company::with('revisionHistory')->get();
    //     $branchRevisions = Branch::with('revisionHistory')->get();
    //     $paymentRevisions = Payment::with('revisionHistory')->get();
    //     $addressRevisions = Address::with('revisionHistory')->get();
    //     $passportRevisions = Passport::with('revisionHistory')->get();

    //     // Combine all revisions into a single collection
    //     $revisions = collect()
    //         ->merge($clientRevisions)
    //         ->merge($companyRevisions)
    //         ->merge($branchRevisions)
    //         ->merge($paymentRevisions)
    //         ->merge($addressRevisions)
    //         ->merge($passportRevisions);

    //     return view('pages.revisions.index', compact('revisions'));
    // }

    public function index()
    {
        // Fetch all revisions
        $revisions = Revision::with('revisionable')->get();

        return view('pages.revisions.index', compact('revisions'));
    }
}
