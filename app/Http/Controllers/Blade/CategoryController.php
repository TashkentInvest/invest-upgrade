<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->get()->all();
        return view('pages.category.index', compact('categories'));
    }

    public function add()
    {
        $categories = Category::where('parent_id', 0)->get()->all();
        return view('pages.category.add', compact('categories'));
    }

    public function create(Request $request)
    {
        $category = new Category();
        // $category->branch_id = $request->get('branch_id');
        $category->name_uz = $request->get('name_uz');
        $category->name_ru = $request->get('name_ru');
        $category->save();
        if ($request->has('parent_id')) {
            $parentCategory = Category::where('id', $request->parent_id)->get()->first();
            $category->parent_id = $parentCategory->id;
            $category->save();
        }
        return redirect()->route('categoryIndex');
    }

    public function edit($id)
    {
        $category = Category::where('id', $id)->get()->first();
        $categories = Category::where('parent_id', 0)->get()->all();
        return view('pages.category.edit', compact('category','categories'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::where('id', $id)->get()->first();
        if($category){
            $category->name_uz = $request->get('name_uz');
            $category->name_ru = $request->get('name_ru');
            $category->save();

            if($request->parent_id != $request->old_parent_id){
                $parentCategory = Category::where('id', $request->parent_id)->get()->first();
                $category->parent_id = $parentCategory->id;
                $category->save();
            }else{
                $category->parent_id = $request->parent_id;
                $category->save();
            }
            return redirect()->route('categoryIndex');
        }else{
            message_set("Data not found !",'error',1);
            return redirect()->route('categoryIndex');
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        message_set("Category deleted !",'success',1);
        return redirect()->back();
    }
}
