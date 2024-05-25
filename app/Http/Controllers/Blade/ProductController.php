<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Regions;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
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
        ]);

        $company = Company::create([
            'client_id' => $client->id,
            'company_location' => $request->get('company_location'),
            'company_type' => $request->get('company_type'),
            'company_kubmetr' => $request->get('company_kubmetr'),
            'company_name' => $request->get('company_name'),
        ]);

        Products::create([
            'company_id' => $company->id,
            'client_id' => $client->id,
            'minimum_wage' => $request->get('minimum_wage'),
            'contract_apt' => $request->get('contract_apt'),
            'contract_date' => $request->get('contract_date'),
            'created_at' => Carbon::today(),
            'updated_at' => Carbon::today()
        ]);

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
