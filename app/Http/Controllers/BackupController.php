<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
  
    public function index()
{
    // Get all files in the 'backups' directory
    $backupFiles = Storage::allFiles('backups');

    // Initialize total size
    $totalSize = 0;

    // Loop through each file and sum up their sizes
    foreach ($backupFiles as $file) {
        $totalSize += Storage::size($file);
    }

    // Convert total size to a more human-readable format
    $totalSizeFormatted = $this->formatBytes($totalSize);

    // Initialize an empty array to store backup details
    $backupDetails = [];

    // Loop through each file to gather backup details
    foreach ($backupFiles as $file) {
        $backupDetails[] = [
            'file' => $file,
            'size' => Storage::size($file), // Get size of the file
            'creation_date' => Storage::lastModified($file), // Get creation date of the file
            'line_count' => $this->countLines($file), // Get line count of the file (assuming it's a text file)
        ];
    }

    // Pass the backup details and total size to the view
    return view('pages.backup.index', compact('backupDetails', 'totalSizeFormatted'));
}

// Function to format bytes to a human-readable format (KB, MB, GB, etc.)
private function formatBytes($bytes, $precision = 2) {
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    // Calculate the size in the chosen unit
    $bytes /= pow(1024, $pow);

    // Format the size with the chosen precision
    return round($bytes, $precision) . ' ' . $units[$pow];
}


    // Function to count lines in a file
    protected function countLines($file)
    {
        $lineCount = exec('wc -l ' . storage_path('app/' . $file));
        return (int)$lineCount;
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
