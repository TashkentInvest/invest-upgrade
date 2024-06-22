<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientHistory;
use App\Models\FileHistory;
use App\Models\AddressHistory;
use App\Models\PassportHistory;
use App\Models\CompanyHistory;
use App\Models\BranchHistory;


class HistoryController extends Controller
{
    // public function index()
    // {
    //     // Subquery to get the latest history timestamp for each client
    //     $latestHistorySubquery = \DB::table('clients')
    //         ->leftJoin('branch_histories', 'clients.id', '=', 'branch_histories.client_id')
    //         ->leftJoin('address_histories', 'clients.id', '=', 'address_histories.client_id')
    //         ->leftJoin('company_histories', 'clients.id', '=', 'company_histories.client_id')
    //         ->leftJoin('passport_histories', 'clients.id', '=', 'passport_histories.client_id')
    //         ->leftJoin('file_histories', 'clients.id', '=', 'file_histories.client_id')
    //         ->select('clients.id')
    //         ->selectRaw('MAX(COALESCE(
    //             GREATEST(
    //                 COALESCE(branch_histories.created_at, 0),
    //                 COALESCE(address_histories.created_at, 0),
    //                 COALESCE(company_histories.created_at, 0),
    //                 COALESCE(passport_histories.created_at, 0),
    //                 COALESCE(file_histories.created_at, 0)
    //             ), 0)) as latest_history_timestamp')
    //         ->groupBy('clients.id');

    //     // Query to fetch clients with latest history timestamp
    //     $clients = Client::leftJoinSub($latestHistorySubquery, 'latest_history', function ($join) {
    //             $join->on('clients.id', '=', 'latest_history.id');
    //         })
    //         ->orderByDesc('clients.updated_at')
    //         ->select('clients.*', 'latest_history.latest_history_timestamp')
    //         ->paginate(25);

    //     // Eager load the latest history record for each type
    //     $clients->load([
    //         'branchHistory' => function ($query) {
    //             $query->orderByDesc('created_at')->take(1);
    //         },
    //         'addressHistory' => function ($query) {
    //             $query->orderByDesc('created_at')->take(1);
    //         },
    //         'companyHistory' => function ($query) {
    //             $query->orderByDesc('created_at')->take(1);
    //         },
    //         'passportHistory' => function ($query) {
    //             $query->orderByDesc('created_at')->take(1);
    //         },
    //         'fileHistory' => function ($query) {
    //             $query->orderByDesc('created_at')->take(1);
    //         },
    //     ]);

    //     return view('pages.history.index', compact('clients'));
    // }
    
    public function index()
    {
        // Fetch clients along with their related histories
        $clientHistories = Client::with([
            'passportHistories',
            'fileHistories',
            'companyHistories',
            'branchHistories',
            'addressHistories'
        ])
        ->where(function ($query) {
            $query->whereHas('passportHistories')
                ->orWhereHas('fileHistories')
                ->orWhereHas('companyHistories')
                ->orWhereHas('branchHistories')
                ->orWhereHas('addressHistories');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10); 
    
        return view('pages.history.index', compact('clientHistories'));
    }
    
 
    public function showHistory($id)
    {
        $client = Client::findOrFail($id);
    
        $clientHistories = $client->clientHistories()->orderBy('created_at', 'desc')->paginate(10);
        $fileHistories = $client->fileHistories()->orderBy('created_at', 'desc')->paginate(10);
        $addressHistories = $client->addressHistories()->orderBy('created_at', 'desc')->paginate(10);
        $passportHistories = $client->passportHistories()->orderBy('created_at', 'desc')->paginate(10);
        $companyHistories = $client->companyHistories()->orderBy('created_at', 'desc')->paginate(10);
        $branchHistories = $client->branchHistories()->orderBy('created_at', 'desc')->paginate(10);
    
        return view('pages.history.show', compact(
            'client',
            'clientHistories',
            'fileHistories',
            'addressHistories',
            'passportHistories',
            'companyHistories',
            'branchHistories'
        ));
    }
    
    
    // public function showHistory($id)
    // {
    //     $client = Client::findOrFail($id);
    
    //     $clientHistories = $client->clientHistories()->orderBy('created_at', 'desc')->paginate(10);
    //     $fileHistories = $client->fileHistories()->orderBy('created_at', 'desc')->paginate(10);
    //     $addressHistories = $client->addressHistories()->orderBy('created_at', 'desc')->paginate(10);
    //     $passportHistories = $client->passportHistories()->orderBy('created_at', 'desc')->paginate(10);
    //     $companyHistories = $client->companyHistories()->orderBy('created_at', 'desc')->paginate(10);
    //     $branchHistories = $client->branchHistories()->orderBy('created_at', 'desc')->paginate(10);
    
    //     $historyTypes = [
    //         'client' => $clientHistories,
    //         'file' => $fileHistories,
    //         'address' => $addressHistories,
    //         'passport' => $passportHistories,
    //         'company' => $companyHistories,
    //         'branch' => $branchHistories,
    //     ];
    
    //     return view('pages.history.show', compact('client', 'historyTypes'));
    // }
    
    
}
