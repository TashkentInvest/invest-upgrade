<?php

namespace App\Http\Controllers\Blade;

use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Branch;
use App\Models\Client;
use App\Models\Company;
use App\Models\File;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Regions;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;




class ProductController extends Controller
{
  
    public function index()
    {
        $products = Products::with('company')->with(['company.branches'])
            ->get()->all();

        $clients = Client::with('products')->where('is_deleted', '!=', 1)->get()->all();

        return view('pages.products.index', compact('products', 'clients'));
    }

    public function show($id)
    {
        $product = Products::findOrFail($id);
        $client = Client::where('id', $product->client_id)->where('is_deleted', '!=', 1)->first();
        $files = $client ? $client->files : collect();
    
        return view('pages.products.show', compact('product', 'client', 'files'));
    }

    public function add()
    {
        $regions = Regions::get()->all();
        return view('pages.products.add', compact('regions'));
    }

    public function create(Request $request)
    {
        DB::beginTransaction();

        try {
            $client = Client::where('passport_serial', $request->get('passport_serial'))->first();

            if (!$client) {
                $client = Client::create([
                    'first_name' => $request->get('first_name'),
                    'last_name' => $request->get('last_name'),
                    'father_name' => $request->get('father_name'),
                    'mijoz_turi' => $request->get('mijoz_turi'),
                    'contact' => $request->get('contact'),
                    'passport_serial' => $request->get('passport_serial'),
                    'passport_pinfl' => $request->get('passport_pinfl'),
                    'passport_date' => $request->get('passport_date'),
                    'passport_location' => $request->get('passport_location'),
                    'passport_type' => $request->get('passport_type', 0),
                    'yuridik_address' => $request->get('yuridik_address'),
                    'yuridik_rekvizid' => $request->get('yuridik_rekvizid'),
                ]);
            }

            if ($request->hasFile('document')) {
                foreach ($request->file('document') as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $fileName = time() . '.' . $extension;
                    $file->move(public_path('assets'), $fileName);
                    
                    $fileModel = new File();
                    $fileModel->client_id = $client->id;
                    $fileModel->path = 'assets/' . $fileName;
                    $fileModel->save();
                }
            }
    
            DB::commit();

            foreach ($request->accordions as $accordion) {
                $company = Company::create([
                    'client_id' => $client->id,
                    'company_location' => $accordion['company_location'] ?? null,
                    'company_type' => $accordion['company_type'] ?? null,
                    'company_name' => $accordion['company_name'] ?? null,
                    'raxbar' => $accordion['raxbar'] ?? null,
                    'bank_code' => $accordion['bank_code'] ?? null,
                    'bank_service' => $accordion['bank_service'] ?? null,
                    'stir' => $accordion['stir'] ?? null,
                    'oked' => $accordion['oked'] ?? null,
                ]);

                $branch = Branch::create([
                    'company_id' => $company->id,
                    'contract_apt' => $accordion['contract_apt'] ?? null,
                    'contract_date' => $accordion['contract_date'] ?? null,
                    'branch_kubmetr' => $accordion['branch_kubmetr'] ?? null,
                    'generate_price' => $accordion['generate_price'] ?? null,
                    'payment_type' => $accordion['payment_type'] ?? null,
                    'percentage_input' => $accordion['percentage_input'] ?? null,
                    'installment_quarterly' => $accordion['installment_quarterly'] ?? null,
                ]);

                Products::create([
                    'user_id' => auth()->user()->id,
                    'client_id' => $client->id,
                    'minimum_wage' => $accordion['minimum_wage'],
                    'created_at' => Carbon::today(),
                    'updated_at' => Carbon::today()
                ]);
            }

            DB::commit();

            return redirect()->route('productIndex')->with('success', 'Product created successfully');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'An error occurred while creating the product: ' . $e->getMessage());
        }
    }


    public function edit($id)
    {
        $product = Products::where('id', $id)->get()->first();
        $regions = Regions::get()->all();
        $client = Client::where('id', $product->client_id)->where('is_deleted', '!=', 1)->first();
        $files = $client ? $client->files : collect();

        return view('pages.products.edit', compact('product', 'regions','client','files'));
    }


    public function update(Request $request, $client_id)
{
    DB::beginTransaction();
    
    try {
        $requestData = $this->getRequestData($request);
    
        // Update client information
        $client = Client::findOrFail($client_id);
        $client->update($requestData['client']);
    
        // Update company information
        $company = Company::where('client_id', $client_id)->firstOrFail();
        $company->update($requestData['company']);
    
        // Update product information
        $product = Products::where('client_id', $client_id)->firstOrFail();
        $product->update($requestData['product']);
    
        // Handle file uploads
        if ($request->hasFile('document')) {
            foreach ($request->file('document') as $file) {
                $extension = $file->getClientOriginalExtension();
                $fileName = time() . '.' . $extension;
                $file->move(public_path('assets'), $fileName);
                
                // Save file path to the "files" table
                $fileModel = new File();
                $fileModel->client_id = $client->id;
                $fileModel->path = 'assets/' . $fileName;
                $fileModel->save();
            }
        }
        
        if ($request->has('delete_files')) {
            foreach ($request->delete_files as $fileId) {
                $file = File::findOrFail($fileId);
                
                if (Storage::exists($file->path)) {
                    Storage::delete($file->path);
                }
                
                $file->delete();
            }
        }
    
        DB::commit();
    
        return redirect()->route('productIndex')->with('success', 'Product updated successfully');
    } catch (\Exception $e) {
        DB::rollback();
    
        return redirect()->back()->with('error', 'An error occurred while updating the product: ' . $e->getMessage());
    }
}

    
    private function getRequestData(Request $request)
    {
        // Get data from the create function
        $client = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'father_name' => $request->father_name,
            'mijoz_turi' => $request->mijoz_turi,
            'contact' => $request->contact,
            'passport_serial' => $request->passport_serial,
            'passport_pinfl' => $request->passport_pinfl,
            'passport_date' => $request->passport_date, 
            'passport_location' => $request->passport_location, 
            'passport_type' => $request->passport_type, 
            'yuridik_address' => $request->yuridik_address, 
            'yuridik_rekvizid' => $request->yuridik_rekvizid, 
        ];
    
        $company = [
            'company_location' => $request->company_location,
            'company_type' => $request->company_type,
            'branch_kubmetr' => $request->branch_kubmetr,
            'company_name' => $request->company_name,
        ];
    
        $product = [
            'minimum_wage' => $request->minimum_wage,
            'contract_apt' => $request->contract_apt,
            'contract_date' => $request->contract_date,
            'updated_at' => Carbon::today()
        ];
    
        return compact('client', 'company', 'product');
    }
    
    public function delete($client_id)
    {
        try {
            $client = Client::findOrFail($client_id);

            $client->update([
                'is_deleted' => 1,
            ]);

            return redirect()->route('productIndex')->with('success', 'Client marked as deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while marking the client as deleted: ' . $e->getMessage());
        }
    }


    public function toggleProductActivation($id)
    {
        $product = Products::where('id', $id)->first();
        $product->status = $product->status === 1 ? 2 : 1;
        $product->save();
        return [
            'is_active' => $product->status
        ];
    }
}
