<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Company;
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

        usort($backupDetails, function ($a, $b) {
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
    public function deleteAll(Request $request)
    {
        $filenames = $request->input('filenames');

        foreach ($filenames as $filename) {
            $filePath = 'backups/' . $filename;
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }

        return redirect()->back()->with('success', 'Selected files deleted successfully.');
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

    public function import()
    {
        $clients = Client::all();
    
        foreach ($clients as $client) {
            $companyData = [
                'client_id' => $client->id,
                'company_name' => $client->company_name ?? null,
                'raxbar' => $client->raxbar ?? null,
                'bank_code' => $client->bank_code ?? null,
                'bank_service' => $client->bank_service ?? null,
                'bank_account' => $client->bank_account ?? null,
                'stir' => $client->stir ?? null,
                'oked' => $client->oked ?? null,
                'minimum_wage' => $client->minimum_wage ?? null,
            ];
    
            // Create a company record
            Company::create($companyData);
    
            // Assuming similar create statements for passport and address relationships
            $client->passport()->create([
                'passport_serial' => $client->passport_serial ?? null,
                'passport_pinfl' => $client->passport_pinfl ?? null,
                'passport_date' => $client->passport_date ?? null,
                'passport_location' => $client->passport_location ?? null,
                'passport_type' => $client->passport_type ?? 0,
            ]);
    
            $client->address()->create([
                'yuridik_address' => $client->yuridik_address ?? null,
                'home_address' => $client->home_address ?? null,
                'company_location' => $client->company_location ?? null,
            ]);
        }
        return redirect()->route('clientIndex')->with('success', 'successfully.');

    }
    
}
