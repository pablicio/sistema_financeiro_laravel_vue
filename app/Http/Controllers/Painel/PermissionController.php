<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;


use App\Projeto\Painel\Permission;
use App\Validators\PermissionValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function index(Permission $permission)
    {
        $permissions = DB::table('permissions')->paginate(5);

        return view('painel.permissions.index', compact('permissions'));
    }


    public function create()
    {
        return view('painel.permissions.create');
    }


    public function store(Request $request)
    {
        $this->customValidate($request->all(), new PermissionValidator());

        $request = $request->all();

        $request['tipo'] = explode('-',$request['name'])[0];

        Permission::create($request);

        return redirect()->to('painel/permissions');
    }

    public function edit($id)
    {
        $permissions = Permission::findOrFail($id);

        return view('painel.permissions.edit', compact('permissions'));
    }


    public function update($id, Request $request)
    {
        $this->customValidate($request->all(), new PermissionValidator(),'update');

        $permissions = Permission::findOrFail($id);

        $permissions->update($request->all());

        return redirect()->to('painel/permissions');
    }


    public function destroy($id)
    {
        Permission::findOrFail($id)->delete();

        return redirect()->to('painel/permissions');
    }

    public function roles(Permission $permission, $id)
    {
        $permissions = $permission->find($id);

        $roles = $permissions->roles()->get();

        return view('painel.permissions.roles', compact('roles', 'permissions'));
    }


}
