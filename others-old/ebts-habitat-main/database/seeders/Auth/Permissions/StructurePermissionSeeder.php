<?php

namespace Database\Seeders\Auth\Permissions;

use App\Domains\Auth\Models\Permission;
use App\Domains\Auth\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;


class StructurePermissionSeeder extends Seeder
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
            'name' => 'admin.access.structure',
            'description' => 'Todos los permisos de Contenido',
        ]);

        $users->children()->saveMany([
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.structure.category',
                'description' => 'Gestionar categorías',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.structure.activity',
                'description' => 'Gestionar actividades',
                'sort' => 2,
            ]),
        ]);

        $this->enableForeignKeys();
    }
}
