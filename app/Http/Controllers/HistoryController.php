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
    public function index()
    {
        // Subquery to get the latest history timestamp for each client
        $latestHistorySubquery = \DB::table('clients')
            ->leftJoin('branch_histories', 'clients.id', '=', 'branch_histories.client_id')
            ->leftJoin('address_histories', 'clients.id', '=', 'address_histories.client_id')
            ->leftJoin('company_histories', 'clients.id', '=', 'company_histories.client_id')
            ->leftJoin('passport_histories', 'clients.id', '=', 'passport_histories.client_id')
            ->leftJoin('file_histories', 'clients.id', '=', 'file_histories.client_id')
            ->select('clients.id')
            ->selectRaw('MAX(COALESCE(
                GREATEST(
                    COALESCE(branch_histories.created_at, 0),
                    COALESCE(address_histories.created_at, 0),
                    COALESCE(company_histories.created_at, 0),
                    COALESCE(passport_histories.created_at, 0),
                    COALESCE(file_histories.created_at, 0)
                ), 0)) as latest_history_timestamp')
            ->groupBy('clients.id');

        // Query to fetch clients with latest history timestamp
        $clients = Client::leftJoinSub($latestHistorySubquery, 'latest_history', function ($join) {
                $join->on('clients.id', '=', 'latest_history.id');
            })
            ->orderByDesc('clients.updated_at')
            ->select('clients.*', 'latest_history.latest_history_timestamp')
            ->paginate(25);

        // Eager load the latest history record for each type
        $clients->load([
            'branchHistory' => function ($query) {
                $query->orderByDesc('created_at')->take(1);
            },
            'addressHistory' => function ($query) {
                $query->orderByDesc('created_at')->take(1);
            },
            'companyHistory' => function ($query) {
                $query->orderByDesc('created_at')->take(1);
            },
            'passportHistory' => function ($query) {
                $query->orderByDesc('created_at')->take(1);
            },
            'fileHistory' => function ($query) {
                $query->orderByDesc('created_at')->take(1);
            },
        ]);

        return view('pages.history.index', compact('clients'));
    }
    

        public function showHistory($id)
        {
            $client = Client::findOrFail($id);
        
            $histories = [
                'client' => ClientHistory::where('client_id', $id)->orderBy('created_at', 'desc')->get(),
                'file' => FileHistory::where('client_id', $id)->orderBy('created_at', 'desc')->get(),
                'address' => AddressHistory::where('client_id', $id)->orderBy('created_at', 'desc')->get(),
                'passport' => PassportHistory::where('client_id', $id)->orderBy('created_at', 'desc')->get(),
                'company' => CompanyHistory::where('client_id', $id)->orderBy('created_at', 'desc')->get(),
                'branch' => BranchHistory::where('client_id', $id)->orderBy('created_at', 'desc')->get(),
            ];
        
            return view('pages.history.show', compact('client', 'histories'));
        }
   
}
