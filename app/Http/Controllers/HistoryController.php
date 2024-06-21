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
            // Fetch all clients
            $clients = Client::paginate(25);
    
            return view('pages.history.index', compact('clients'));
        }
    
        public function showHistory($id)
        {
            // Fetch the specific client
            $client = Client::findOrFail($id);
        
            // Fetch all history records grouped by type
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
