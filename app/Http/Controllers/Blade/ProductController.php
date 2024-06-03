<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Client;
use App\Models\Company;
use App\Models\File;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Regions;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;


class ProductController extends Controller
{

    public function index()
    {
        // Cache the query result for 60 minutes
        $clients = Cache::remember('clients_with_products', 60, function() {
            return Client::with([
                    'products',
                    'branches' 
                ])
                ->where('is_deleted', '!=', 1)
                ->orderBy('updated_at', 'desc')
                ->get(); 
        });
    
        return view('pages.products.index', compact('clients'));
    }
    
    
    public function show($id)
    {
        // Find the product by ID
        $product = Products::findOrFail($id);
    
        // Find the client associated with the product, eager loading companies, branches, and files
        $client = Client::where('id', $product->client_id)
                        ->with(['branches', 'files'])
                        ->where('is_deleted', '!=', 1)
                        ->firstOrFail();
    
        // Check if client files exist, otherwise set to an empty collection
        $files = $client ? $client->files : collect();
    
        // Pass product, client, and files data to the view
        return view('pages.products.show', compact('product', 'client', 'files'));
    }
    
    public function add()
    {
        $regions = Regions::get()->all();
        return view('pages.products.add', compact('regions'));
    }

    public function create(Request $request)
    {
        // dd($request);
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
                    'client_description' => $request->get('client_description'),

                    'company_location' => $request->get('company_location') ?? null,
                    'company_type' => $request->get('company_type') ?? null,
                    'company_name' => $request->get('company_name') ?? null,
                    'raxbar' => $request->get('raxbar') ?? null,
                    'bank_code' => $request->get('bank_code') ?? null,
                    'bank_service' => $request->get('bank_service') ?? null,
                    'stir' => $request->get('stir') ?? null,
                    'oked' => $request->get('oked') ?? null,
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
                // dd($request);

                $branch = Branch::create([
                    'client_id' => $client->id, // Assuming client_id is the correct foreign key
                    'contract_apt' => $accordion['contract_apt'] ?? null,
                    'contract_date' => $accordion['contract_date'] ?? null,
                    'branch_kubmetr' => $accordion['branch_kubmetr'] ?? null,
                    'generate_price' => $accordion['generate_price'] ?? null,
                    'payment_type' => $accordion['payment_type'] ?? null,
                    'percentage_input' => $accordion['percentage_input'] ?? null,
                    'installment_quarterly' => $accordion['installment_quarterly'] ?? null,
                    'notification_num' => $accordion['notification_num'] ?? null,
                    'notification_date' => $accordion['notification_date'] ?? null,
                    'insurance_policy' => $accordion['insurance_policy'] ?? null,
                    'bank_guarantee' => $accordion['bank_guarantee'] ?? null,
                    'application_number' => $accordion['application_number'] ?? null,
                    'payed_sum' => $accordion['payed_sum'] ?? null,
                    'payed_date' => $accordion['payed_date'] ?? null,
                    'first_payment_percent' => $accordion['first_payment_percent'] ?? null,
                ]);
                // dd($branch);
            
                Products::create([
                    'user_id' => auth()->user()->id,
                    'client_id' => $client->id,
                    'minimum_wage' => $accordion['minimum_wage'],
                    'created_at' => Carbon::today(),
                    'updated_at' => Carbon::today(),
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

        return view('pages.products.edit', compact('product', 'regions', 'client', 'files'));
    }

    public function update(Request $request, $client_id)
    {
        DB::beginTransaction();
    
        try {
            // Update client information
            $client = Client::findOrFail($client_id);
            $client->update([
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
                'client_description' => $request->client_description,

                'company_location' => $request->get('company_location') ?? null,
                'company_type' => $request->get('company_type') ?? null,
                'company_name' => $request->get('company_name') ?? null,
                'raxbar' => $request->get('raxbar') ?? null,
                'bank_code' => $request->get('bank_code') ?? null,
                'bank_service' => $request->get('bank_service') ?? null,
                'stir' => $request->get('stir') ?? null,
                'oked' => $request->get('oked') ?? null,
            ]);
    
            // Get existing companies for the client
            $existingCompanies = Company::where('client_id', $client_id)->get();
    
            // Update company and branch information
            foreach ($request->accordions as $index => $accordion) {
                // Check if the company exists
            
    
                // Get existing branches for the company
                $existingBranches = Branch::where('client_id', $client->id)->get();
    
                if (isset($accordion['branches'])) {
                    foreach ($accordion['branches'] as $branchIndex => $branchData) {
                        $branch = $existingBranches->skip($branchIndex)->first();
    
                        if (!$branch) {
                            $branch = Branch::create([
                                'client_id' => $client->id,
                                'contract_apt' => $branchData['contract_apt'] ?? null,
                                'contract_date' => $branchData['contract_date'] ?? null,
                                'branch_kubmetr' => $branchData['branch_kubmetr'] ?? null,
                                'generate_price' => $branchData['generate_price'] ?? null,
                                'payment_type' => $branchData['payment_type'] ?? null,
                                'percentage_input' => $branchData['percentage_input'] ?? null,
                                'installment_quarterly' => $branchData['installment_quarterly'] ?? null,
                                'notification_num' => $branchData['notification_num'] ?? null,
                                'notification_date' => $branchData['notification_date'] ?? null,
                                'insurance_policy' => $branchData['insurance_policy'] ?? null,
                                'bank_guarantee' => $branchData['bank_guarantee'] ?? null,
                                'application_number' => $branchData['application_number'] ?? null,
                                'payed_sum' => $branchData['payed_sum'] ?? null,
                                'payed_date' => $branchData['payed_date'] ?? null,
                                'first_payment_percent' => $branchData['first_payment_percent'] ?? null,
                            ]);
                        } else {
                            // Update the existing branch
                            $branch->update([
                                'client_id' => $client->id,
                                'contract_apt' => $branchData['contract_apt'] ?? null,
                                'contract_date' => $branchData['contract_date'] ?? null,
                                'branch_kubmetr' => $branchData['branch_kubmetr'] ?? null,
                                'generate_price' => $branchData['generate_price'] ?? null,
                                'payment_type' => $branchData['payment_type'] ?? null,
                                'percentage_input' => $branchData['percentage_input'] ?? null,
                                'installment_quarterly' => $branchData['installment_quarterly'] ?? null,
                                'notification_num' => $branchData['notification_num'] ?? null,
                                'notification_date' => $branchData['notification_date'] ?? null,
                                'insurance_policy' => $branchData['insurance_policy'] ?? null,
                                'bank_guarantee' => $branchData['bank_guarantee'] ?? null,
                                'application_number' => $branchData['application_number'] ?? null,
                                'payed_sum' => $branchData['payed_sum'] ?? null,
                                'payed_date' => $branchData['payed_date'] ?? null,
                                'first_payment_percent' => $branchData['first_payment_percent'] ?? null,
                            ]);
                        }
                    }
                }
            }
    
            // Update product information
            $product = Products::where('client_id', $client_id)->firstOrFail();
            $product->update([
                'minimum_wage' => $request->minimum_wage,
                'contract_apt' => $request->contract_apt,
                'contract_date' => $request->contract_date,
                'created_at' => Carbon::today(),
                'updated_at' => Carbon::today(),
            ]);
    
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
    
            // Handle file deletions
            if ($request->has('delete_files') && is_array($request->delete_files)) {
                foreach ($request->delete_files as $fileId) {
                    $file = File::find($fileId);
                    if ($file) {
                        if (Storage::exists($file->path)) {
                            Storage::delete($file->path);
                        }
                        $file->delete();
                    }
                }
            }
    
            DB::commit();
    
            return redirect()->route('productIndex')->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
    
            return redirect()->back()->with('error', 'An error occurred while updating the product: ' . $e->getMessage());
        }
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
