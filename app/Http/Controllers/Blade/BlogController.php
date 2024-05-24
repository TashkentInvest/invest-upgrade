<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::get()->all();
        return view('pages.blogs.index',compact('blogs'));
    }

    public function add()
    {
        return view('pages.blogs.add');
    }

    public function create(Request $request)
    {
        $blog = new Blog();
        $blog->name_uz = $request->get('name_uz');
        $blog->name_ru = $request->get('name_ru');
        $blog->text_uz = $request->get('text_uz');
        $blog->text_ru = $request->get('text_ru');
        $blog->save();
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $name = time() . '.' . $extension;
            $blog->photo = $name;
            $blog->save();
            $file->move($blog->public_path(), $name);
        }
        return redirect()->route('blogIndex');
    }

    public function edit($id)
    {
        $blog = Blog::where('id', $id)->get()->first();
        return view('pages.blogs.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::where('id', $id)->get()->first();
        if($blog){
            $blog->name_uz = $request->get('name_uz');
            $blog->name_ru = $request->get('name_ru');
            $blog->text_uz = $request->get('text_uz');
            $blog->text_ru = $request->get('text_ru');
            $blog->save();

            if ($request->hasFile('photo')) {
                if ($blog->photo) {
                    $imagePath = public_path('images/' . $blog->photo);
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
                $blog->photo = $name;
                $blog->save();
                // Move the file using the modified filename
                $file->move($blog->public_path(), $name);
            }
            return redirect()->route('blogIndex');
        }else{
            message_set("Data not found !",'error',1);
            return redirect()->route('blogIndex');
        }
    }

    public function destroy($id)
    {
        $blog = Blog::find($id);
        $blog->delete();
        message_set("blog deleted !",'success',1);
        return redirect()->back();
    }

    public function toggleblogActivation($id)
    {
        $blog = Blog::where('id',$id)->first();
        $blog->status = $blog->status === 1 ? 2 : 1;
        $blog->save();
        return [
            'is_active' => $blog->status
        ];
    }
}
