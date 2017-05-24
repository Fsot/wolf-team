<?php
/**
 * Created by PhpStorm.
 * User: antoinefissot
 * Date: 02/04/2017
 * Time: 20:55
 */

namespace wolfteam\Http\Controllers\Administration;

use wolfteam\Http\Controllers\Controller;
use wolfteam\Http\Requests\AssignRoleUserRequest;
use wolfteam\Models\Role;
use wolfteam\Models\User;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $users = User::all();
        $roles = Role::pluck('display_name', 'id');
        return view('users.index', compact('users', 'roles'));
    }

    public function assign_role(AssignRoleUserRequest $request, $u)
    {
        if($u){
            $user = User::findOrFail($u);
            if($user){
                $user->roles()->sync([$request->role]);
                return redirect()->back()->with('success', 'L\'utilisateur a bien été mis à jour.');
            }
        }
        return redirect()->back()->with('error', 'Erreur sur la sauvegarde des données.');
    }

}