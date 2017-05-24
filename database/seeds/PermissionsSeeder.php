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
            ],
            4 => [
                'name' => 'add_thread_admin',
                'display_name' => 'ADMINISTRATION // Ajouter un thread dans une chaîne',
                'description' => 'Permettre d\'ajouter un thread dans la partie administration du site.',
            ],
            5 => [
                'name' => 'edit_thread_admin',
                'display_name' => 'ADMINISTRATION // Editer un thread dans une chaîne',
                'description' => 'Permettre d\'éditer un thread dans la partie administration du site.',
            ],
            6 => [
                'name' => 'delete_thread_admin',
                'display_name' => 'ADMINISTRATION // Supprimer un thread dans une chaîne',
                'description' => 'Permettre de supprimer un thread dans la partie administration du site.',
            ],
            7 => [
                'name' => 'activate_forum',
                'display_name' => 'Activer/desactiver le forum',
                'description' => 'Permettre d\'activer ou de désactiver le forum.',
            ],
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

        $blackWords = [
            0 => [
              'name' => 'list_blackWords',
              'display_name' => 'Liste des mots noir',
              'description' => 'Voir la liste des mots noir (Partie administration du site).',
            ],
            1 => [
              'name' => 'add_blackWords',
              'display_name' => 'Ajouter des mots noir',
              'description' => 'Ajouter des mots noir (Partie administration du site).',
            ],
            2 => [
              'name' => 'delete_blackWords',
              'display_name' => 'Supprimer des mots noir',
              'description' => 'Supprimer des mots noir (Partie administration du site)',
            ],
        ];

        $categories = [
          0 => [
              'name' => 'add_category_forum',
              'display_name' => 'Ajouter une catégorie de forum',
              'description' => 'Permettre d\'ajouter une catégorie de forum.'
          ],
          1 => [
              'name' => 'delete_category_forum',
              'display_name' => 'Supprimer une catégorie de forum',
              'description' => 'Permettre de supprimer une catégorie de forum.'
          ]
        ];

        $access = [
            0 => [
                'name' => 'access_securities',
                'display_name' => 'accé à la sécurité du site',
                'description' => 'Permettre d\'accéder à la gestion de la sécurité du site'
            ],
            1 => [
                'name' => 'access_permission',
                'display_name' => 'accé aux permission du site',
                'description' => 'Permettre d\'accéder à la gestion des permissions du site'
            ],
            2 => [
                'name' => 'access_role',
                'display_name' => 'accé aux rôles du site',
                'description' => 'Permettre d\'accéder à la gestion des rôles du site'
            ],
            3 => [
                'name' => 'access_user_edit',
                'display_name' => 'accé aux utilisateurs du site',
                'description' => 'Permettre d\'accéder à la gestion des utilisateurs du site'
            ],
        ];

        DB::table('permissions')->insert($thread);
        DB::table('permissions')->insert($channel);
        DB::table('permissions')->insert($message);
        DB::table('permissions')->insert($role);
        DB::table('permissions')->insert($blackWords);
        DB::table('permissions')->insert($categories);
        DB::table('permissions')->insert($access);


    }
}
