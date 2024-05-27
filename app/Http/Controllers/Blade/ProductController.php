<?php

namespace App\Http\Controllers\Blade;

use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Client;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Regions;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;



class ProductController extends Controller
{
    public function downloadTableData($id)
    {
        // Export the data to Excel using the ProductsExport class
        return Excel::download(new ProductsExport($id), 'products_data.xls');
        // return Excel::download(new ProductsExport($id, $clientName), 'products_data_' . $clientName . '.xls');
// 
    }
    public function index()
    {
        $products = Products::with('company')
        ->get()->all();

        $clients = Client::with('products')->get()->all();
        // dd($products);

        return view('pages.products.index', compact('products','clients'));
    }

    public function show($id)
    {
        $product = Products::where('id', $id)->with('company')->get()->first();
        $client = Client::where('id', $id)->get()->first();

        return view('pages.products.show', compact('product','client'));
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
        // Check if the client already exists
        $client = Client::where('passport_serial', $request->get('passport_serial'))->first();

        if (!$client) {
            // Create the client if it doesn't exist
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
                'passport_type' => $request->get('passport_type', 0) ,
                'yuridik_address' => $request->get('yuridik_address'),
                'yuridik_rekvizid' => $request->get('yuridik_rekvizid'),

            ]);

            // dd($client);
        }

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
                'user_id'=> auth()->user()->id,
                'client_id' => $client->id,
                'minimum_wage' => $accordion['minimum_wage'],
                'created_at' => Carbon::today(),
                'updated_at' => Carbon::today()
            ]);

            // $products = Products::get()->all();
            // dd($products);

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
        return view('pages.products.edit', compact('product', 'regions'));
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
                'passport_date' => $request->passport_date, // Corrected
                'passport_location' => $request->passport_location, // Corrected
                'passport_type' => $request->passport_type, // Corrected
                'yuridik_address' => $request->yuridik_address, // Added
                'yuridik_rekvizid' => $request->yuridik_rekvizid, // Added
            ]);
    
            // Update company information
            $company = Company::where('client_id', $client_id)->firstOrFail();
            $company->update([
                'company_location' => $request->company_location,
                'company_type' => $request->company_type,
                'branch_kubmetr' => $request->branch_kubmetr,
                'company_name' => $request->company_name,
            ]);
    
            // Update product information
            $product = Products::where('client_id', $client_id)->firstOrFail();
            $product->update([
                'minimum_wage' => $request->minimum_wage,
                'contract_apt' => $request->contract_apt,
                'contract_date' => $request->contract_date,
                'updated_at' => Carbon::today()
            ]);
    
            DB::commit();
    
            return redirect()->route('productIndex')->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
    
            return redirect()->back()->with('error', 'An error occurred while updating the product: ' . $e->getMessage());
        }
    }
    

    public function delete($client_id)
    {
        DB::beginTransaction();

        try {
            $client = Client::findOrFail($client_id);

            $company = Company::where('client_id', $client_id)->firstOrFail();

            $product = Products::where('company_id', $company->id)
                                ->where('client_id', $client_id)
                                ->firstOrFail();

            $product->delete();

            $company->delete();

            $client->delete();

            DB::commit();

            return redirect()->route('productIndex')->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'An error occurred while deleting the product: ' . $e->getMessage());
        }
    }

    public function toggleProductActivation($id)
    {
        $product = Products::where('id',$id)->first();
        $product->status = $product->status === 1 ? 2 : 1;
        $product->save();
        return [
            'is_active' => $product->status
        ];
    }
}
