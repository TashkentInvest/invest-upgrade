<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class AuditLogController extends Controller
{
    public function index()
    {
        $auditLogs = AuditLog::with(['user', 'client'])->orderBy('created_at', 'desc')->paginate(10);
        return view('pages.audit-logs.index', compact('auditLogs'));
    }
    
}
