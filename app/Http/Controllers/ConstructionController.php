<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConstructionController extends Controller
{
    public function index(){
        $constructions = Client::deepFilters()
        ->with(['company','branches','address','passport'])
        ->where('is_deleted', '!=', 1)->orderBy('id', 'desc')
        ->paginate(25);
        
        return view('pages.construction.tasks.index', compact('constructions'));
    }

    public function show($id){

        $construction = Client::with(['company','branches','address','passport'])->find($id);
        return view('pages.construction.tasks.show', compact('construction'));

    }

    public function edit($id){
        

        $construction = Client::where('id', $id)
        ->with(['branches', 'files'])
        ->where('is_deleted', '!=', 1)
        ->firstOrFail();

        
        return view('pages.construction.tasks.edit', compact('construction'));
    }

    public function update(Request $request, $id)
    {

        DB::beginTransaction();

        try {

            $client = Client::findOrFail($id);
            $client->update([
                'contract_apt' => $request->get('contract_apt'),
                'contract_date' => $request->get('contract_date'),
                'apz_raqami' => $request->get('apz_raqami'),
                'apz_sanasi' => $request->get('apz_sanasi'),
                'kengash' => $request->get('kengash'),
            ]);


            foreach ($request->accordions as $accordionData) {
                $branch = Branch::find($accordionData['id']);

                if ($branch) {
                    $branch->update($accordionData);
                } else {
                    $branch = new Branch($accordionData);
                    $branch->client_id = $client->id;
                    $branch->save();
                }
            }

            DB::commit();

            $currentPage = $request->input('page', 1);

            return redirect()->route('clientIndex', ['page' => $currentPage])->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'An error occurred while updating the product: ' . $e->getMessage());
        }
    }
}
