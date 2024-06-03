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
        $auditLogs = AuditLog::with(['user', 'client'])->orderBy('created_at', 'desc')->get();
        return view('pages.audit-logs.index', compact('auditLogs'));
    }
    // public function index()
    // {
    //     $auditLogs = AuditLog::with(['user', 'client'])->orderBy('created_at', 'desc')->get();
    //     return view('pages.audit-logs.index', compact('auditLogs'));
    // }
    
}
