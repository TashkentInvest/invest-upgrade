<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index()
    {
        $auditLogs = AuditLog::with(['user','client', 'company'])->get();
        return view('pages.audit-logs.index', compact('auditLogs'));
    }
    
}
