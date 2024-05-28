<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use PhpOffice\PhpWord\TemplateProcessor;

class HomeController extends Controller
{
    

    public function index()
    {
        $userId = auth()->id();

        $hasRoles = DB::table('model_has_roles')
            ->where('model_id', $userId)
            ->exists();

        if ($hasRoles) {
            return view('pages.dashboard');
        } else {
            return view('welcome');
        }
    }

    public function getClientData($id)
    {
        return DB::table('clients')
            ->join('companies', 'clients.id', '=', 'companies.client_id')
            ->join('branches', 'companies.id', '=', 'branches.company_id')
            ->select(
                'clients.id',
                'clients.first_name',
                'clients.last_name',
                'clients.father_name',
                'clients.first_name as client_name',
                'companies.company_name',
                'companies.company_location',
                'companies.raxbar',
                'branches.contract_apt',
                'branches.contract_date',
                'branches.branch_kubmetr',
                'branches.generate_price',
                'branches.payment_type',
                'branches.percentage_input',
                'branches.installment_quarterly'
            )
            ->where('clients.id', $id)
            ->first();
    }

    public function generateDocx()
    {
        // Load the template
        $templatePath = storage_path('АРТ 30.24_ooo.docx');
        $templateProcessor = new TemplateProcessor($templatePath);
    
        // Set data
        $first_name = "John";
        $last_name = "Doe";
        $company_name = "Example Company";
    
        // Replace placeholders with actual data
        $templateProcessor->setValue('first_name', $first_name);
        $templateProcessor->setValue('last_name', $last_name);
        $templateProcessor->setValue('company_name', $company_name);
        // Add more replacements as needed
    
        // Save the updated document
        $outputPath = storage_path('helloWorld.docx');
        $templateProcessor->saveAs($outputPath);
    
        // Download the document
        return response()->download($outputPath);
    }
    
    
}
