<?php
/**
 * Created by PhpStorm.
 * User: antoinefissot
 * Date: 03/04/2017
 * Time: 09:08
 */

namespace wolfteam\Http\Controllers\Administration;

use wolfteam\Http\Controllers\Controller;
use wolfteam\Http\Requests\DeleteRolesRequest;
use wolfteam\Http\Requests\UpdatePermissionRoleRequest;
use wolfteam\Http\Requests\UpdateRolesRequest;
use wolfteam\Models\Permission;
use wolfteam\Models\Role;

class RolesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $roles = Role::all();

        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $role = new Role();
        return view('roles.create', compact('role'));
    }

    public function store(UpdateRolesRequest $request)
    {
        $role = $this->created($request->all());
        if($role){
            return  redirect()->action('Administration\RolesController@index')->with('success', 'Le rôle a bien été sauvegarder');
        }
        return  redirect()->action('Administration\RolesController@index')->with('error', 'Erreur sur la sauvegarde du role');
    }

    public function destroy(DeleteRolesRequest $request)
    {
        $role = Role::findOrFail($request->id);
        if($role) {
            $role->delete();
            return redirect()->back()->with('success', 'Le role a bien été suprrimer.');
        }
        return redirect()->back()->with('error', 'Ce role ne semble pas exister');
    }

    public function edit_permission($id)
    {
        $permissions = Permission::all();
        $role = Role::findOrFail($id);
        return view('roles.edit_permission', compact('permissions', 'role'));
    }

    public function update_permission(UpdatePermissionRoleRequest $request, $role)
    {
        $role = Role::where('id', $role)->first();
        if($role){
            $data = Permission::whereIn('name', $request->except(['_method', '_token']))->pluck('id');
            if(null !== $data->all()){
                $role->perms()->sync($data->all());

                return redirect()->back()->with('success', 'Le role a bien été mis à jour.');
            }
        }
        return redirect()->back()->with('error', 'Erreur sur la mise à jour du role.');
    }

    protected function created($data){
        return Role::create([
           'name' => $data['name'],
           'display_name' => $data['display_name'],
           'description' => $data['description'],
        ]);
    }
}