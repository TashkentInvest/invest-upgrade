<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function allCategory(){
        $categories = Category::get()->all();
        return $categories;
    }

    public function showCategory($id){
        $category = Category::find($id);
        return $category;    
    }

    public function updateCategory(Request $request, $id){
        $category = Category::find($id);

        if($category){
         
            $category = Category::where('id', $id)->first();
            $category->status_id = 5;
            $category->save();
    
        }else{
            $response = [
                "message" => "category not found!"
            ];
        }
        return $response;
    }

    public function deleteCategory($id) {
        $category = Category::find($id);
        if($category){
          $category->delete();
        }else{
            $response = [
                "message" => "category not found !"
            ];
        }
        return $response;
    }
}
