<?php

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $thread = [
            0 => [
                'name' => 'add_thread',
                'display_name' => 'Ajouter un thread',
                'description' => 'Permettre d\'ajouter un thread',
            ],
            1 => [
                'name' => 'edit_thread',
                'display_name' => 'Editer un thread',
                'description' => 'Permettre d\'editer un thread',
            ],
            2 => [
                'name' => 'delete_thread',
                'display_name' => 'Supprimer un thread',
                'description' => 'Permettre de supprimer un thread',
            ],
            3 => [
                'name' => 'add_thread_channel_block',
                'display_name' => 'Ajouter un thread dans une channel bloquer',
                'description' => 'Permettre d\'ajouter un thread dans une channel bloquer',
            ]
        ];

        $channel = [
            0 => [
                'name' => 'add_channel',
                'display_name' => 'Ajouter une channel',
                'description' => 'Permettre d\'ajouter une channel',
            ],
            1 => [
                'name' => 'edit_channel',
                'display_name' => 'Editer une channel',
                'description' => 'Permettre d\'editer une channel',
            ],
            2 => [
                'name' => 'delete_channel',
                'display_name' => 'Supprimer une channel',
                'description' => 'Permettre de supprimer une channel',
            ]
        ];

        $message = [
            0 => [
                'name' => 'add_message',
                'display_name' => 'Ajouter un message',
                'description' => 'Permettre d\'ajouter un message',
            ],
            1 => [
                'name' => 'edit_message',
                'display_name' => 'Editer un message',
                'description' => 'Permettre d\'editer un message',
            ],
            2 => [
                'name' => 'delete_message',
                'display_name' => 'Supprimer un message',
                'description' => 'Permettre de supprimer un message',
            ],
            4 => [
                'name' => 'edit_other_message',
                'display_name' => 'Editer un autre message',
                'description' => 'Permettre d\'editer un message qui ne lui appartient pas',
            ],
            5 => [
                'name' => 'delete_other_message',
                'display_name' => 'Supprimer un autre message',
                'description' => 'Permettre de supprimer un message qui ne lui appartient pas',
            ]
        ];

        $role = [
            0 => [
                'name' => 'add_role',
                'display_name' => 'Ajouter un role',
                'description' => 'Permettre d\'ajouter un role',
            ],
            1 => [
                'name' => 'edit_role',
                'display_name' => 'Editer un role',
                'description' => 'Permettre d\'editer un role',
            ],
            2 => [
                'name' => 'delete_role',
                'display_name' => 'Supprimer un role',
                'description' => 'Permettre de supprimer un role',
            ]
        ];

        DB::table('permissions')->insert($thread);
        DB::table('permissions')->insert($channel);
        DB::table('permissions')->insert($message);
        DB::table('permissions')->insert($role);


    }
}
