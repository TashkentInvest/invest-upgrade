<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class AuditLogController extends Controller
{
    public function index()
    {

        $auditLogs = Cache::remember('auditLogs', 30 * 60, function () {
            return AuditLog::with(['user', 'client'])->orderBy('created_at', 'desc')->get();
        });
        
        return view('pages.audit-logs.index', compact('auditLogs'));
    }

    //     We want to cache the result for 30 minutes.
    // 1 minute has 60 seconds, so 30 minutes would be 30 * 60 seconds.
    // Therefore, we set the cache to expire after 30 * 60 seconds, which equals 1800 seconds.
    
}
