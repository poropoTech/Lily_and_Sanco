<?php

namespace Database\Seeders\Auth;

use App\Domains\Auth\Models\Role;
use App\Domains\Auth\Models\User;
use Database\Seeders\Auth\Permissions\AppConfigPermissionSeeder;
use Database\Seeders\Auth\Permissions\StructurePermissionSeeder;
use Database\Seeders\Auth\Permissions\UserContentPermissionSeeder;
use Database\Seeders\Auth\Permissions\UserPermissionSeeder;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Create Roles
        Role::create([
            'id' => 1,
            'type' => User::TYPE_ADMIN,
            'name' => 'Administrator',
        ]);

        Role::create([
            'id' => 2,
            'type' => User::TYPE_ADMIN,
            'name' => 'Administrador',
        ]);

        Role::create([
            'id' => 3,
            'type' => User::TYPE_ADMIN,
            'name' => 'Editor',
        ]);

        Role::create([
            'id' => 4,
            'type' => User::TYPE_ADMIN,
            'name' => 'Moderador',
        ]);

        // Non Grouped Permissions
        //

        // Grouped permissions

        $this->call(UserPermissionSeeder::class);
        $this->call(StructurePermissionSeeder::class);
        $this->call(UserContentPermissionSeeder::class);
        $this->call(AppConfigPermissionSeeder::class);

        // Assign Permissions to other Roles
        //

        DB::table('role_has_permissions')->insert(
            [
                ['permission_id' => 1, 'role_id' => 2],
                ['permission_id' => 9, 'role_id' => 2],
                ['permission_id' => 12, 'role_id' => 2],
                ['permission_id' => 17, 'role_id' => 2],
                ['permission_id' => 9, 'role_id' => 3],
                ['permission_id' => 12, 'role_id' => 4],

            ]
        );

        $this->enableForeignKeys();
    }
}
