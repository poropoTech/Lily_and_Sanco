<?php

namespace Database\Seeders\Auth\Permissions;

use App\Domains\Auth\Models\Permission;
use App\Domains\Auth\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;


class UserContentPermissionSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        $users = Permission::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.user-content',
            'description' => 'Todos los permisos de Contenido de usuarios',
        ]);

        $users->children()->saveMany([
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.user-content.publish-responses',
                'description' => 'Publicar/Despublicar respuestas a desafíos',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.user-content.publish-comments',
                'description' => 'Publicar/Despublicar comentarios',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.user-content.delete-responses',
                'description' => 'Eliminar respuestas a desafíos',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.user-content.delete-comments',
                'description' => 'Eliminar comentarios',
            ]),
        ]);

        $this->enableForeignKeys();
    }
}
