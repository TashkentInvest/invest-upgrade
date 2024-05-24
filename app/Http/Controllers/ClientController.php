<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Services\LogWriter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        // abort_if_forbidden('client.show');
        $clients = Client::where('id','!=',auth()->user()->id)->get();
        return view('pages.client.index',compact('clients'));
    }

    public function add()
    {
        abort_if_forbidden('client.add');
        if (auth()->user()->hasRole('Super Admin'))
            $roles = Role::all();
        else
            $roles = Role::where('name','!=','Super Admin')->get();
        return view('pages.client.add',compact('roles'));
    }

    // user create
    public function create(Request $request)
    {
        abort_if_forbidden('client.add');
        $this->validate($request,[
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
        ]);

        $client = Client::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'father_name' => $request->get('father_name'),
            'mijoz_turi' => $request->get('mijoz_turi'),
            'contact' => $request->get('contact'),
            'passport_serial' => $request->get('passport_serial'),
            'passport_pinfl' => $request->get('passport_pinfl'),
            'yuridik_address' => $request->get('yuridik_address'),
            'yuridik_rekvizid' => $request->get('yuridik_rekvizid'),
        ]);

        return redirect()->route('clientIndex');
    }

    // user edit page
    public function edit($id)
    {
        abort_if((!auth()->user()->can('client.edit') && auth()->id() != $id),403);

        $client = Client::find($id);

        if ($client->hasRole('Super Admin') && !auth()->user()->hasRole('Super Admin'))
        {
            message_set("У вас нет разрешения на редактирование администратора",'error',5);
            return redirect()->back();
        }

        if (auth()->user()->hasRole('Super Admin'))
            $roles = Role::all();
        else
            $roles = Role::where('name','!=','Super Admin')->get();

        return view('pages.client.edit',compact('client','roles'));
    }

    // update user dates
    public function update(Request $request, $id)
    {
        abort_if((!auth()->user()->can('client.edit') && auth()->id() != $id),403);

        $client = Client::find($id);

        $client->first_name = $request->get('first_name');
        $client->last_name = $request->get('last_name');
        $client->father_name = $request->get('father_name');
        $client->mijoz_turi = $request->get('mijoz_turi');

        $client->contact = $request->get('contact');
        $client->passport_serial = $request->get('passport_serial');
        $client->passport_pinfl = $request->get('passport_pinfl');
        $client->yuridik_address = $request->get('yuridik_address');
        $client->yuridik_rekvizid = $request->get('yuridik_rekvizid');

        if (auth()->user()->can('client.edit'))
            return redirect()->route('clientIndex');
        else
            return redirect()->route('home');
    }

    // delete user by id
    public function destroy($id)
    {
        abort_if_forbidden('client.delete');

        $client = Client::destroy($id);
        if ($client->hasRole('Super Admin') && !auth()->user()->hasRole('Super Admin'))
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
