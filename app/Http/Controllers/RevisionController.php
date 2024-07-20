<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Company;
use App\Models\Branch;
use App\Models\Passport;
use App\Models\Address;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use Venturecraft\Revisionable\Revision;

class RevisionController extends Controller
{
    // public function index()
    // {
    //     // Fetch all revisions
    //     $revisions = Revision::with('revisionable')->get();

    //     // Fetch deleted clients, companies, branches, passports, addresses, payments
    //     $deletedClients = Client::onlyTrashed()->get();
    //     $deletedCompanies = Company::onlyTrashed()->get();
    //     $deletedBranches = Branch::onlyTrashed()->get();
    //     $deletedPassports = Passport::onlyTrashed()->get();
    //     $deletedAddresses = Address::onlyTrashed()->get();
    //     $deletedPayments = Payment::onlyTrashed()->get();

    //     return view('pages.revisions.index', compact(
    //         'revisions',
    //         'deletedClients',
    //         'deletedCompanies',
    //         'deletedBranches',
    //         'deletedPassports',
    //         'deletedAddresses',
    //         'deletedPayments'
    //     ));
    // }
    public function index()
    {
        // Cache duration in minutes
        $cacheDuration = 60;

        // Fetch all revisions and cache them
        $revisions = Cache::remember('revisions', $cacheDuration, function () {
            return Revision::with('revisionable')->get();
        });

        // Fetch deleted clients, companies, branches, passports, addresses, payments and cache them
        $deletedClients = Cache::remember('deletedClients', $cacheDuration, function () {
            return Client::onlyTrashed()->get();
        });

        $deletedCompanies = Cache::remember('deletedCompanies', $cacheDuration, function () {
            return Company::onlyTrashed()->get();
        });

        $deletedBranches = Cache::remember('deletedBranches', $cacheDuration, function () {
            return Branch::onlyTrashed()->get();
        });

        $deletedPassports = Cache::remember('deletedPassports', $cacheDuration, function () {
            return Passport::onlyTrashed()->get();
        });

        $deletedAddresses = Cache::remember('deletedAddresses', $cacheDuration, function () {
            return Address::onlyTrashed()->get();
        });

        $deletedPayments = Cache::remember('deletedPayments', $cacheDuration, function () {
            return Payment::onlyTrashed()->get();
        });

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
