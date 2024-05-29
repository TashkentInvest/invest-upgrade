<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    // public function index()
    // {
    //     try {
    //         $auditLogs = AuditLog::with(['user', 'client', 'company'])
    //                              ->orderBy('created_at', 'desc')
    //                              ->get();
    //     } catch (\Exception $e) {
    //         return back()->withError($e->getMessage())->withInput();
    //     }
    
    //     return view('pages.audit-logs.index', compact('auditLogs'));
    // }
    
    public function index()
{
    $query = AuditLog::with(['user', 'client', 'company'])->orderBy('created_at', 'desc');
    // dd($query->toSql()); // Debug the generated SQL query/

    $auditLogs = $query->get();
    return view('pages.audit-logs.index', compact('auditLogs'));
}

    
}
