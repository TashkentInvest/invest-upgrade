<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Client;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConstructionController extends Controller
{ 
    public function index()
    {
        $userId = auth()->user()->id;
    
        $constructions = Client::with(['company', 'branches' => function ($query) use ($userId) {
            $query->whereNotNull('payed_sum')
                    ->select('id', 'branch_name', 'generate_price', 'contract_date', 'payment_type', 'percentage_input', 'installment_quarterly', 'branch_kubmetr', 'branch_location', 'client_id')
                    ->whereDoesntHave('views', function ($q) use ($userId) {
                        $q->where('user_id', $userId)
                        ->where('status', 1);
                    })
                    ->with('views');
        }, 'address', 'passport'])
        ->whereHas('branches', function ($query) {
            $query->whereNotNull('payed_sum')
                    ->orWhere('payed_sum', '>=', DB::raw('generate_price'));
        })
        ->where('is_deleted', '!=', 1)
        ->orderBy('id', 'desc')
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

            // dd($request);
            foreach ($request->accordions as $accordionData) {
                $branch = Branch::find($accordionData['id']);

                if ($branch) {
                    $branch->update($accordionData);
                } else {
                    $branch = new Branch($accordionData);
                    $branch->save();
                }
            }

            DB::commit();

            return redirect()->back()->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'An error occurred while updating the product: ' . $e->getMessage());
        }
    }

   
    public function updateStatus(Request $request)
    {
        // dump($request);
    
        View::create([
            'user_id' => auth()->id(),
            'branch_id' => $request->branch_id,
            'status' => $request->status,
        ]);
    
        return response()->json(['success' => true]);
    }
    
}
