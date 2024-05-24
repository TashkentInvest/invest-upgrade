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
        // abort_if_forbidden('user.show');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        $client = Client::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $client->assignRole($request->get('roles'));

        $activity = "\nCreated by: ".json_encode(auth()->user())
            ."\nNew Client: ".json_encode($client)
            ."\nRoles: ".implode(", ",$request->get('roles') ?? []);

        LogWriter::user_activity($activity,'AddingUsers');

        return redirect()->route('userIndex');
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

        return view('pages.client.edit',compact('user','roles'));
    }

    // update user dates
    public function update(Request $request, $id)
    {
        abort_if((!auth()->user()->can('client.edit') && auth()->id() != $id),403);

        $activity = "\nUpdated by: ".logObj(auth()->user());
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $client = Client::find($id);

        if ($request->get('password') != null)
        {
            $client->password = Hash::make($request->get('password'));
        }

        unset($request['password']);
        $activity .="\nBefore updates Client: ".logObj($client);
        $activity .=' Roles before: "'.implode(',',$client->getRoleNames()->toArray()).'"';

        $client->fill($request->all());
        $client->save();

        if (isset($request->roles)) $client->syncRoles($request->get('roles'));
        unset($client->roles);

        $activity .="\nAfter updates Client: ".logObj($client);
        $activity .=' Roles after: "'.implode(',',$client->getRoleNames()->toArray()).'"';

        LogWriter::user_activity($activity,'EditingUsers');

        if (auth()->user()->can('client.edit'))
            return redirect()->route('userIndex');
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
        return redirect()->route('userIndex');
    }

    public function setTheme(Request $request,$id)
    {
        $this->validate($request,[
            'theme' => 'required'
        ]);

        if (!in_array($request->theme,['default','dark','light']))
        {
            message_set("There is no theme like $request->theme!",'warning',3);
        }
        else
        {
            $client = Client::findOrFail($id);
            $client->setTheme($request->theme);
            message_set("Theme `$request->theme` is installed!",'success',1);
        }

        return redirect()->back();
    }
}
