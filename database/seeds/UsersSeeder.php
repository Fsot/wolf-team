<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'name'      => 'admin',
            'email'     => 'aze@aze.fr',
            'password'  => bcrypt('azeaze'),
            'user_ip'   => \Illuminate\Support\Facades\Request::ip()
        ];

        $persist = DB::table('users')->insert($user);
        if($persist){
            $user = \wolfteam\Models\User::select('id')->first();
            if($user){
                $role = \wolfteam\Models\Role::select('id')->first();
                if($role){
                    $data = [
                        'user_id' => $user->id,
                        'role_id' => $role->id,
                    ];
                    DB::table('role_user')->insert($data);
                }
                $profil = [
                    'user_id' => $user->id
                ];
                DB::table('profils')->insert($profil);
            }
        }
    }
}
