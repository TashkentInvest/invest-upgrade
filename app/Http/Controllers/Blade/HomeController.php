<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;


class HomeController extends Controller
{
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

    public function optimize()
    {
        Artisan::call('cache:clear-optimize');
        return redirect()->back()->with('success', 'Optimized cache cleared successfully');
    }
}
