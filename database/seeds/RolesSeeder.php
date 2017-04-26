<?php

use Illuminate\Database\Seeder;
use wolfteam\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            'name' => 'sup_admin',
            'display_name' => 'Super administrateur',
            'description' => 'Super administrateur du site, il a tous les droits et ne peut pas être supprimer',
        ];


        $persist = DB::table('roles')->insert($role);
        unset($role);
        if($persist){
            $role = \wolfteam\Models\Role::first();
            $permissions  = Permission::select('id')->get();
            foreach ($permissions as $permission) {
                $data[] = [
                    'permission_id' => $permission->id,
                    'role_id'       => $role->id
                ];
            }
            DB::table('permission_role')->insert($data);
        }
    }
}
