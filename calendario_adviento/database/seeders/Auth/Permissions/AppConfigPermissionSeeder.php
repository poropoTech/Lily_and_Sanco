<?php

namespace Database\Seeders\Auth\Permissions;

use App\Domains\Auth\Models\Permission;
use App\Domains\Auth\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;


class AppConfigPermissionSeeder extends Seeder
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
            'name' => 'admin.access.app-config',
            'description' => 'Todos los permisos de configuración',
        ]);

        $users->children()->saveMany([
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.app-config.notifications',
                'description' => 'Gestionar notificaciones',
            ]),
        ]);

        $this->enableForeignKeys();
    }
}
