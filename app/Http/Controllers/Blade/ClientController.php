<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Client;
use App\Models\Company;
use App\Models\File;
use Illuminate\Http\Request;
use App\Models\Regions;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::deepFilters()->with(['company','branches','address','passport','files'])->where('is_deleted', '!=', 1)->orderBy('id', 'desc')
            ->paginate(25);

        return view('pages.products.index', compact('clients'));
    }

    public function show($id)
    {
        $client = Client::where('id', $id)
            ->with(['company','branches','address','passport','files'])
            ->where('is_deleted', '!=', 1)
            ->get()->first();

        $files = $client ? $client->files : collect();

        if ($client) {
            return view('pages.products.show', compact('client', 'files'));
        } else {
            return response()->view('errors.custom', ['status' => 404, 'message' => 'Applicant Not found'], 404);
        }
    }

    public function add()
    {
        $regions = Regions::get()->all();
        return view('pages.products.add', compact('regions'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'stir' => 'nullable|string|max:9|min:9|unique:companies,stir',
            'oked' => 'nullable|string|max:5|min:5',
            'bank_code' => 'nullable|string|max:5|min:5',
            'bank_account' => 'nullable|string|max:20|min:20',
            'passport_serial' => 'nullable|string|max:10|min:9',
            'passport_pinfl' => 'nullable|string|max:14|min:14',
        ]);
        // dd($request);
        

        DB::beginTransaction();

        try {
            $client = Client::create([
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'father_name' => $request->get('father_name'),
                'mijoz_turi' => $request->get('mijoz_turi'),
                'contact' => $request->get('contact'),
                'client_description' => $request->get('client_description'),
            ]);

            $client->company()->create([
                'company_name' => $request->get('company_name') ?? null,
                'raxbar' => $request->get('raxbar') ?? null,
                'bank_code' => $request->get('bank_code') ?? null,
                'bank_service' => $request->get('bank_service') ?? null,
                'bank_account' => $request->get('bank_account') ?? null,
                'stir' => $request->get('stir') ?? null,
                'oked' => $request->get('oked') ?? null,
                'minimum_wage' => $request->get('minimum_wage') ?? null,
            ]);

            $client->passport()->create([
                'passport_serial' => $request->get('passport_serial') ?? null,
                'passport_pinfl' => $request->get('passport_pinfl') ?? null,
                'passport_date' => $request->get('passport_date') ?? null,
                'passport_location' => $request->get('passport_location') ?? null,
                'passport_type' => $request->get('passport_type') ?? 0,
            ]);

            $client->address()->create([
                'yuridik_address' => $request->get('yuridik_address') ?? null,
                'home_address' => $request->get('home_address') ?? null,
                'company_location' => $request->get('company_location') ?? null,
            ]);

            if ($request->hasFile('document')) {
                foreach ($request->file('document') as $file) {
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $date = date('Ymd_His');
                    $fileName = $originalName . '_' . $date . '.' . $extension;
                    $file->move(public_path('assets'), $fileName);

                    $fileModel = new File();
                    $fileModel->client_id = $client->id;
                    $fileModel->path = 'assets/' . $fileName;
                    $fileModel->save();
                }
            }


            foreach ($request->accordions as $accordion) {
                Branch::create([
                    'client_id' => $client->id,
                    'contract_apt' => $accordion['contract_apt'] ?? null,
                    'contract_date' => $accordion['contract_date'] ?? null,
                    'branch_kubmetr' => $accordion['branch_kubmetr'] ?? null,
                    'branch_type' => $accordion['branch_type'] ?? null,
                    'branch_location' => $accordion['branch_location'] ?? null,
                    'branch_name' => $accordion['branch_name'] ?? null,
                    'generate_price' => $accordion['generate_price'] ?? null,
                    'payment_type' => $accordion['payment_type'] ?? null,
                    'percentage_input' => $accordion['percentage_input'] ?? null,
                    'installment_quarterly' => $accordion['installment_quarterly'] ?? null,
                    'notification_num' => $accordion['notification_num'] ?? null,
                    'notification_date' => $accordion['notification_date'] ?? null,
                    'insurance_policy' => $accordion['insurance_policy'] ?? null,
                    'bank_guarantee' => $accordion['bank_guarantee'] ?? null,
                    'application_number' => $accordion['application_number'] ?? null,
                    'payed_sum' => $accordion['payed_sum'] ?? null,
                    'payed_date' => $accordion['payed_date'] ?? null,
                    'first_payment_percent' => $accordion['first_payment_percent'] ?? null,
                ]);
            }

            DB::commit();

            return redirect()->route('clientIndex')->with('success', 'Client created successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'An error occurred while creating the client: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {

        $client = Client::where('id', $id)
            ->with(['branches', 'files'])
            ->where('is_deleted', '!=', 1)
            ->firstOrFail();

        $files = $client ? $client->files : collect();

        return view('pages.products.edit', compact('client', 'files'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // 'stir' => 'nullable|string|max:9|min:9|unique:clients,stir',
            'oked' => 'nullable|string|max:5|min:5',
            'bank_code' => 'nullable|string|max:5|min:5',
            'bank_account' => 'nullable|string|max:20|min:20',
            'passport_serial' => 'nullable|string|max:10|min:9',
            'passport_pinfl' => 'nullable|string|max:14|min:14',
        ]);

        DB::beginTransaction();

        try {

            $client = Client::findOrFail($id);
            $client->update([
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'father_name' => $request->get('father_name'),
                'mijoz_turi' => $request->get('mijoz_turi'),
                'contact' => $request->get('contact'),
                'client_description' => $request->get('client_description'),
            ]);

            $client->company->update([
                'company_name' => $request->get('company_name') ?? null,
                'raxbar' => $request->get('raxbar') ?? null,
                'bank_code' => $request->get('bank_code') ?? null,
                'bank_service' => $request->get('bank_service') ?? null,
                'bank_account' => $request->get('bank_account') ?? null,
                'stir' => $request->get('stir') ?? null,
                'oked' => $request->get('oked') ?? null,
                'minimum_wage' => $request->get('minimum_wage') ?? null,
            ]);

            $client->passport->update([
                'passport_serial' => $request->get('passport_serial') ?? null,
                'passport_pinfl' => $request->get('passport_pinfl') ?? null,
                'passport_date' => $request->get('passport_date') ?? null,
                'passport_location' => $request->get('passport_location') ?? null,
                'passport_type' => $request->get('passport_type') ?? 0,
            ]);

            $client->address->update([
                'yuridik_address' => $request->get('yuridik_address') ?? null,
                'home_address' => $request->get('home_address') ?? null,
                'company_location' => $request->get('company_location') ?? null,
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

            if ($request->hasFile('document')) {
                foreach ($request->file('document') as $file) {
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $date = date('Ymd_His');
                    $fileName = $originalName . '_' . $date . '.' . $extension;
                    $file->move(public_path('assets'), $fileName);

                    $fileModel = new File();
                    $fileModel->client_id = $client->id;
                    $fileModel->path = 'assets/' . $fileName;
                    $fileModel->save();
                }
            }

            if ($request->has('delete_files')) {
                foreach ($request->input('delete_files') as $fileId) {
                    $file = File::find($fileId);
                    if ($file) {
                        if (Storage::exists($file->path)) {
                            Storage::delete($file->path);
                        }
                        $file->delete();
                    }
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


    public function delete($id)
    {
        try {
            $client = Client::where('id', $id)->firstOrFail();

            $client->update([
                'is_deleted' => 1,
            ]);

            return redirect()->route('clientIndex')->with('success', 'Client marked as deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while marking the client as deleted: ' . $e->getMessage());
        }
    }

    public function toggleclientActivation($id)
    {
        $client = Client::where('id', $id)->first();
        $client->status = $client->status === 1 ? 2 : 1;
        $client->save();
        return [
            'is_active' => $client->status
        ];
    }
}
