<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;


class HomeController extends Controller
{
    // public function index()
    // {
    //     $is_role_exists = DB::select("SELECT COUNT(*) as cnt FROM `model_has_roles` WHERE model_id = ".auth()->id());

    //     if ($is_role_exists[0]->cnt)
    //         return view('pages.dashboard');
    //     else
    //         return view('welcome');
    // }

    public function index()
    {
        $userId = auth()->id();

        $hasRoles = DB::table('model_has_roles')
            ->where('model_id', $userId)
            ->exists();

        if ($hasRoles) {
            return view('pages.dashboard');
        } else {
            return view('welcome');
        }
    }

    public function generateDocx()
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $description = "<p>Lorem ipsum <strong>dolor sit amet</strong>, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. <em>Ut enim ad minim veniam</em>,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>";
    
        // Add an image to the section
        $section->addImage("https://via.placeholder.com/150?text=raviyatechnical");
    
        // Add HTML content to the section
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $description);
    
        // Create the writer
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    
        try {
            $objWriter->save(storage_path('helloWorld.docx'));
        } catch (Exception $e) {
            // Handle the exception if needed
        }
    
        return response()->download(storage_path('helloWorld.docx'));
    }
    
}
