<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Services\LogWriter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Client;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        // abort_if_forbidden('client.show');
        $companies = Company::where('user_id','!=',auth()->user()->id)->get();
        return view('pages.client.index',compact('companies'));
    }

    public function add()
    {
    
        return view('pages.client.add');
    }

    // user create
    public function create(Request $request)
    {
        abort_if_forbidden('client.add');
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'raxbar' => ['required', 'string', 'max:255'],
        ]);

        $company = Company::create([
            'client_id' => $request->get('client_id'),
            'name' => $request->get('name'),
            'raxbar' => $request->get('raxbar'),
            'company_location' => $request->get('company_location'),
            'branch_kubmetr' => $request->get('branch_kubmetr'),
        ]);
        

        return redirect()->route('clientIndex');
    }

    // user edit page
    public function edit($id)
    {
        abort_if((!auth()->user()->can('client.edit') && auth()->id() != $id),403);

        $company = Company::find($id);

        return view('pages.client.edit',compact('client'));
    }

    // update user dates
    public function update(Request $request, $id)
    {
        abort_if((!auth()->user()->can('client.edit') && auth()->id() != $id),403);

        $client = Client::find($id);

        $client->name = $request->get('name');
        $client->raxbar = $request->get('raxbar');
        $client->company_location = $request->get('company_location');
        $client->branch_kubmetr = $request->get('branch_kubmetr');
        $client->save();

        if (auth()->user()->can('client.edit'))
            return redirect()->route('clientIndex');
        else
            return redirect()->route('home');
    }

    // delete user by id
    public function destroy($id)
    {
        abort_if_forbidden('client.delete');

        $company = Company::destroy($id);
        if ($company->hasRole('Super Admin') && !auth()->user()->hasRole('Super Admin'))
        {
            message_set("У вас нет разрешения на редактирование администратора",'error',5);
            return redirect()->back();
        }
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        DB::table('model_has_permissions')->where('model_id',$id)->delete();
        $deleted_by = logObj(auth()->user());
        $client_log = logObj(Client::find($id));
        $message = "\nDeleted By: $deleted_by\nDeleted Client: $client_log";
        LogWriter::user_activity($message,'DeletingUsers');
        return redirect()->route('clientIndex');
    }
}
