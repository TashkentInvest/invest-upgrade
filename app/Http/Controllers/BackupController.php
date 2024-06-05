<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    public function index()
    {
        // Get the list of backup files
        $backupFiles = Storage::files('backups');

        // Collect details for each backup file
        $backupDetails = [];
        foreach ($backupFiles as $file) {
            $backupDetails[] = [
                'file' => $file,
                'size' => Storage::size($file), // Size in bytes
                'creation_date' => Storage::lastModified($file), // Date of creation
                'line_count' => $this->countLines($file), // Number of lines in the file
            ];
        }

        return view('pages.backup.index', compact('backupDetails'));
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
