<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{

    public function index()
    {
        $backupFiles = Storage::allFiles('backups');
        $totalSize = 0;
    
        foreach ($backupFiles as $file) {
            $totalSize += Storage::size($file);
        }
    
        $totalSizeFormatted = $this->formatBytes($totalSize);
    
        $backupDetails = [];
    
        foreach ($backupFiles as $file) {
            $backupDetails[] = [
                'file' => $file,
                'size' => Storage::size($file),
                'creation_date' => Storage::lastModified($file),
            ];
        }
    
        usort($backupDetails, function($a, $b) {
            return $b['creation_date'] <=> $a['creation_date'];
        });
    
        return view('pages.backup.index', compact('backupDetails', 'totalSizeFormatted'));
    }
    
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    public function download($filename)
    {
        $filePath = 'backups/' . $filename;

        if (Storage::exists($filePath)) {
            return Storage::download($filePath);
        } else {
            return redirect()->back()->with('error', 'File not found.');
        }
    }

    public function delete($filename)
    {
        $filePath = 'backups/' . $filename;

        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
            return redirect()->back()->with('success', 'File deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'File not found.');
        }
    }
}
