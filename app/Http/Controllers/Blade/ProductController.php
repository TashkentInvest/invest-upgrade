<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Regions;

class ProductController extends Controller
{
    public function index()
    {
        $products = Products::with('region')->get()->all();
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
        $product = new Products();
        $product->name_uz = $request->get('name_uz');
        $product->name_ru = $request->get('name_ru');
        $product->text_uz = $request->get('text_uz');
        $product->text_ru = $request->get('text_ru');
        $product->longitude = $request->get('longitude');
        $product->latitude = $request->get('latitude');
        $product->region_id = $request->get('region_id');
        $product->category_id = $request->get('category_id');
        $product->save();
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $name = time() . '.' . $extension;
            $product->photo = $name;
            $product->save();
            $file->move($product->public_path(), $name);
        }
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
