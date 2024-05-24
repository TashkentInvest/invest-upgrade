<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Programs;

class JobController extends Controller
{
    public function index()
    {
        $programs = Programs::get()->all();
        return view('pages.jobs.programs.index', compact('programs'));
    }

    public function add()
    {
        return view('pages.jobs.programs.add');
    }

    public function create(Request $request)
    {
        $program = new Programs();
        $program->name_uz = $request->get('name_uz');
        $program->name_ru = $request->get('name_ru');
        $program->save();
        return redirect()->route('jobProgramIndex');
    }

    public function edit($id)
    {
        $program = Programs::where('id', $id)->get()->first();
        return view('pages.jobs.programs.edit', compact('program'));
    }

    public function update(Request $request, $id)
    {
        $program = Programs::find($id);
        $program->name_uz = $request->get('name_uz');
        $program->name_ru = $request->get('name_ru');
        $program->save();
        return redirect()->route('jobProgramIndex');
    }

    public function destroy($id)
    {
        $program = Programs::find($id);
        $program->delete();
        message_set("Program deleted !",'success',1);
        return redirect()->back();
    }

    public function toggleProductActivation($id)
    {
        $program = Programs::where('id',$id)->first();
        $program->status = $program->status === 1 ? 2 : 1;
        $program->save();
        return [
            'is_active' => $program->status
        ];
    }
}
