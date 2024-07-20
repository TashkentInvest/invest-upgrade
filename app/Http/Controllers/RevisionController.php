<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Company;
use App\Models\Branch;
use App\Models\Passport;
use App\Models\Address;
use App\Models\Payment;
use Illuminate\Http\Request;
use Venturecraft\Revisionable\Revision;

class RevisionController extends Controller
{
    public function index()
    {
        // Fetch all revisions
        $revisions = Revision::with('revisionable')->get();
    
        // Fetch deleted clients, companies, branches, passports, addresses, payments
        $deletedClients = Client::onlyTrashed()->get();
        $deletedCompanies = Company::onlyTrashed()->get();
        $deletedBranches = Branch::onlyTrashed()->get();
        $deletedPassports = Passport::onlyTrashed()->get();
        $deletedAddresses = Address::onlyTrashed()->get();
        $deletedPayments = Payment::onlyTrashed()->get();
    
        return view('pages.revisions.index', compact(
            'revisions',
            'deletedClients',
            'deletedCompanies',
            'deletedBranches',
            'deletedPassports',
            'deletedAddresses',
            'deletedPayments'
        ));
    }
    public function clientDetails($id)
    {
        $client = Client::withTrashed()->findOrFail($id);
        $revisions = Revision::where('revisionable_type', Client::class)
                             ->where('revisionable_id', $id)
                             ->get();
        return view('pages.revisions.client-details', compact('client', 'revisions'));
    }
        
}