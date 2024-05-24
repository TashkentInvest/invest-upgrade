<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\StartMessage;

class SettingsController extends Controller
{
    //
    public function startMessage()
    {
        $message = StartMessage::get()->all();
        return view('pages.settings.index', compact('message'));
    }

    public function startMessageAdd()
    {
        return view('pages.settings.add');
    }

    public function startMessageCreate(Request $request)
    {
        $message = StartMessage::get()->all();
        if(empty($message)){
            $message = new StartMessage();
            $message->text = $request->get('text');
            $message->save();

            if ($request->hasFile('picture')) {
                $file = $request->file('picture');
                // Extract the original filename without the extension
                $originalFilename = $file->getClientOriginalName();
                // Extract the file extension
                $extension = $file->getClientOriginalExtension();
                // Combine the modified filename with the extension
                $name = time() . '.' . $extension;
                // Save the modified filename to the database
                $message->picture = $name;
                $message->save();
                // Move the file using the modified filename
                $file->move($message->public_path(), $name);
            }
            return redirect()->route('settingStartMessage');
        }else{
            message_set("You have had already start message",'error',1);
            return redirect()->route('settingStartMessage');
        }
    }

    public function startMessageEdit($id)
    {
        $message = StartMessage::where('id', $id)->get()->first();
        return view('pages.settings.edit', compact('message'));
    }

    public function startMessageUpdate(Request $request, $id)
    {
        $message = StartMessage::where('id', $id)->get()->first();
        if($message){
            $message->text = $request->get('text');
            $message->save();

            if ($request->hasFile('picture')) {
                if ($message->picture) {
                    $imagePath = public_path('images/' . $message->picture);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
                
                $file = $request->file('picture');
                // Extract the file extension
                $extension = $file->getClientOriginalExtension();
                // Combine the modified filename with the extension
                $name = time() . '.' . $extension;
                // Save the modified filename to the database
                $message->picture = $name;
                $message->save();
                // Move the file using the modified filename
                $file->move($message->public_path(), $name);
            }
            return redirect()->route('settingStartMessage');
        }else{
            message_set("Data not found !",'error',1);
            return redirect()->route('settingStartMessage');
        }
    }
    
    public function aboutCompany()
    {
        $about = About::first();
        return view('pages.settings.company.index', compact('about'));
    }

    public function editCompany()
    {
        $about = About::first();
        return view('pages.settings.company.edit', compact('about'));
    }

    public function updateCompany(Request $request)
    {
        $this->validate($request, [
            'name_uz' => 'required',
            'name_ru' => 'required',
            'description_uz' => 'required',
            'description_ru' => 'required',
        ]);
        $about = About::first();
        if($about){
            $about->name_uz = $request->get('name_uz');
            $about->name_ru = $request->get('name_ru');
            $about->text_uz = $request->get('description_uz');
            $about->text_ru = $request->get('description_ru');
            $about->link_name_1 = $request->get('link_name_1') ?? null;
            $about->link_1 = $request->get('link_1') ?? null;
            $about->link_name_2 = $request->get('link_name_2') ?? null;
            $about->link_2 = $request->get('link_2') ?? null;
            $about->save();

            if ($request->hasFile('photo')) {
                if ($about->image) {
                    $imagePath = public_path('images/' . $about->image);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }

                $file = $request->file('photo');
                // Extract the original filename without the extension
                $originalFilename = $file->getClientOriginalName();
                $filenameWithoutExtension = pathinfo($originalFilename, PATHINFO_FILENAME);
                // Extract the file extension
                $extension = $file->getClientOriginalExtension();
                // Combine the modified filename with the extension
                $name = time() . '.' . $extension;
                // Save the modified filename to the database
                $about->image = $name;
                $about->save();
                // Move the file using the modified filename
                $file->move($about->public_path(), $name);
            }else{
                if(!is_null($request->delete_image)){
                    if($request->delete_image){
                        if ($about->image) {
                            $imagePath = public_path('images/' . $about->image);
                            if (file_exists($imagePath)) {
                                unlink($imagePath);
                            };
                            $about->image = null;
                            $about->save();
                        }
                    }
                }
            }
        }else{
            $about = new About();
            $about->name_uz = $request->get('name_uz');
            $about->name_ru = $request->get('name_ru');
            $about->text_uz = $request->get('description_uz');
            $about->text_ru = $request->get('description_ru');
            $about->link_name_1 = $request->get('linl_name_1') ?? null;
            $about->link_1 = $request->get('link_1') ?? null;
            $about->link_name_2 = $request->get('linl_name_2') ?? null;
            $about->link_2 = $request->get('link_2') ?? null;
            $about->save();

            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                // Extract the original filename without the extension
                $originalFilename = $file->getClientOriginalName();
                $filenameWithoutExtension = pathinfo($originalFilename, PATHINFO_FILENAME);
                // Extract the file extension
                $extension = $file->getClientOriginalExtension();
                // Combine the modified filename with the extension
                $name = time() . '.' . $extension;
                // Save the modified filename to the database
                $about->image = $name;
                $about->save();
                // Move the file using the modified filename
                $file->move($about->public_path(), $name);
            }
        }
        return redirect()->route('settingAbout');
    }
}
