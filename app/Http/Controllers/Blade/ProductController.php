<?php

namespace App\Http\Controllers\Blade;

use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
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
        // dd($products);

        return view('pages.products.index', compact('products'));
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
        // Create the client
        $client = Client::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'father_name' => $request->get('father_name'),
            'mijoz_turi' => $request->get('mijoz_turi'),
            'contact' => $request->get('contact'),
            'passport_serial' => $request->get('passport_serial'),
            'passport_pinfl' => $request->get('passport_pinfl'),
            'yuridik_address' => $request->get('yuridik_address'),
            'yuridik_rekvizid' => $request->get('yuridik_rekvizid'),
            'jamgarma_rekvizitlari' => $request->get('jamgarma_rekvizitlari'),
        ]);

        // Loop through each set of accordion data and create related records
        foreach ($request->accordions as $accordion) {
            $company = Company::create([
                'client_id' => $client->id,
                'company_location' => $accordion['company_location'],
                'company_type' => $accordion['company_type'],
                'company_kubmetr' => $accordion['company_kubmetr'],
                'company_name' => $accordion['company_name'],
            ]);

            Products::create([
                'company_id' => $company->id,
                'client_id' => $client->id,
                'minimum_wage' => $accordion['minimum_wage'],
                'contract_apt' => $accordion['contract_apt'],
                'contract_date' => $accordion['contract_date'],
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
                'yuridik_address' => $request->yuridik_address,
                'yuridik_rekvizid' => $request->yuridik_rekvizid,
                'jamgarma_rekvizitlari' => $request->jamgarma_rekvizitlari,
                
            ]);
    
            // Update company information
            $company = Company::where('client_id', $client_id)->firstOrFail();
            $company->update([
                'company_location' => $request->company_location,
                'company_type' => $request->company_type,
                'company_kubmetr' => $request->company_kubmetr,
                'company_name' => $request->company_name,
            ]);
    
            // Update product information
            $product = Products::where('company_id', $company->id)
                                ->where('client_id', $client_id)
                                ->firstOrFail();
            $product->update([
                'minimum_wage' => $request->minimum_wage,
                'contract_apt' => $request->get('contract_apt'),
                'contract_date' => $request->get('contract_date'),

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
