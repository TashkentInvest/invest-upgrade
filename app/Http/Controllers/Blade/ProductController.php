<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Regions;
use Carbon\Carbon;

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
        $categories = Category::where('parent_id', 1)->get()->all();

        return view('pages.products.add', compact('regions','categories'));
    }

    public function create(Request $request)
    {
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
    
        $client_id = $client->id;
      
        $company = Company::create([
            'client_id' => $client_id, 
            'company_location' => $request->get('company_location'),
            'company_type' => $request->get('company_type'),
            'company_kubmetr' => $request->get('company_kubmetr'), 
            'company_name' => $request->get('company_name'), 
        ]);
    
        $company_id = $company->id;
    
        $product = Products::create([
            'company_id' => $company_id,
            'client_id' => $client_id,
            'minimum_wage'=>$request->get('minimum_wage'), 
            'created_at' => Carbon::today(),
            'updated_at' => Carbon::today()
        ]);
       
        return redirect()->route('productIndex');
    }
    

    public function edit($id)
    {
        $product = Products::where('id', $id)->get()->first();
        $regions = Regions::get()->all();
        return view('pages.products.edit', compact('product', 'regions'));
    }

    public function update(Request $request, $id)
    {
        $product = Products::where('id', $id)->get()->first();
        if($product){
            $product->name_uz = $request->get('name_uz');
            $product->name_ru = $request->get('name_ru');
            $product->text_uz = $request->get('text_uz');
            $product->text_ru = $request->get('text_ru');
            $product->longitude = $request->get('longitude');
            $product->latitude = $request->get('latitude');
            $product->region_id = $request->get('region_id');
            $product->save();

            if ($request->hasFile('photo')) {
                if ($product->photo) {
                    $imagePath = public_path('images/' . $product->photo);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
                
                $file = $request->file('photo');
                // Extract the file extension
                $extension = $file->getClientOriginalExtension();
                // Combine the modified filename with the extension
                $name = time() . '.' . $extension;
                // Save the modified filename to the database
                $product->photo = $name;
                $product->save();
                // Move the file using the modified filename
                $file->move($product->public_path(), $name);
            }
            return redirect()->route('productIndex');
        }else{
            message_set("Data not found !",'error',1);
            return redirect()->route('productIndex');
        }
    }

    public function destroy($id)
    {
        $product = Products::find($id);
        $product->delete();
        message_set("product deleted !",'success',1);
        return redirect()->back();
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
