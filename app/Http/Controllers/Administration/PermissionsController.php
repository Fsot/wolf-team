<?php
/**
 * Created by PhpStorm.
 * User: antoinefissot
 * Date: 03/04/2017
 * Time: 09:04
 */

namespace wolfteam\Http\Controllers\Administration;


use wolfteam\Http\Controllers\Controller;
use wolfteam\Http\Requests\DeletePermissionRequest;
use wolfteam\Http\Requests\UpdatePermissionRequest;
use wolfteam\Models\Permission;

class PermissionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $permissions = Permission::all();

        return view('permissions.index', compact('permissions'));
    }

    public function create()
    {
        $permission = new Permission();
        return view('permissions.create', compact('permission'));
    }

    public function store(UpdatePermissionRequest $request)
    {
        $permission = $this->created($request->all());
        if($permission){
            return  redirect()->action('Administration\PermissionsController@index')->with('success', 'La permission a bien été sauvegarder');
        }
        return  redirect()->action('Administration\PermissionsController@index')->with('error', 'Erreur sur la sauvegarde de la permission');
    }

    public function destroy(DeletePermissionRequest $request)
    {
        $permission = Permission::findOrFail($request->id);
        if($permission) {
            $permission->delete();
            return redirect()->back()->with('success', 'La permission a bien été suprrimer.');
        }
        return redirect()->back()->with('error', 'Cette permission ne semble pas exister');
    }

    protected function created($data){
        return Permission::create([
            'name' => $data['name'],
            'display_name' => $data['display_name'],
            'description' => $data['description'],
        ]);
    }
}