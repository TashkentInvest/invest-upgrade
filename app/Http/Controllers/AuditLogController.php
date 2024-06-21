<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Client;
use App\Models\ClientHistory;
use App\Models\FileHistory;
use App\Models\AddressHistory;
use App\Models\PassportHistory;
use App\Models\CompanyHistory;
use App\Models\BranchHistory;


class AuditLogController extends Controller
{
          // $auditLogs = AuditLog::with(['user', 'client'])->orderBy('created_at', 'desc')->paginate(10);
        // return view('pages.audit-logs.index', compact('auditLogs'));

        public function index()
        {
            // Fetch all clients
            $clients = Client::paginate(25);
    
            return view('pages.audit-logs.index', compact('clients'));
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
        
            return view('pages.audit-logs.show', compact('client', 'histories'));
        }
    
}
