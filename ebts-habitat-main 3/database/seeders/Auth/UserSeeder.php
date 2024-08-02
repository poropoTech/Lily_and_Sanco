<?php

namespace Database\Seeders\Auth;

use App\Domains\Auth\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

/**
 * Class UserTableSeeder.
 */
class UserSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Add the master administrator, user id of 1
        User::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'Super Admin',
            'alias' => 'Super Admin',
            'email' => 'superadmin@admin.com',
            'password' => 'secret',
            'email_verified_at' => now(),
            'active' => true,
        ]);

        $admin = User::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'Admin',
            'alias' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => 'secret',
            'email_verified_at' => now(),
            'active' => true,
        ]);

        $admin->syncRoles(['Administrador']);

        $editor = User::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'Manager',
            'alias' => 'Manager',
            'email' => 'manager@admin.com',
            'password' => 'secret',
            'email_verified_at' => now(),
            'active' => true,
        ]);

        $editor->syncRoles(['Editor', 'Moderador']);

        $editor = User::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'Editor',
            'alias' => 'Editor',
            'email' => 'editor@admin.com',
            'password' => 'secret',
            'email_verified_at' => now(),
            'active' => true,
        ]);

        $editor->syncRoles(['Editor']);

        $moderador = User::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'Moderador',
            'alias' => 'Moderador',
            'email' => 'moderador@admin.com',
            'password' => 'secret',
            'email_verified_at' => now(),
            'active' => true,
        ]);

        $moderador->syncRoles(['Moderador']);


        if (app()->environment(['local', 'testing'])) {
            for ($i = 1; $i <= 5; $i++) {
                $this->addTestUser($i);
            }
        }

        $this->enableForeignKeys();
    }

    private function addTestUser($number)
    {
        $user = User::create([
            'type' => User::TYPE_USER,
            'name' => 'Test User '.$number,
            'alias' => 'Alias User '.$number,
            'email' => 'user'.$number.'@user.com',
            'password' => 'secret',
            'email_verified_at' => now(),
            'active' => true,
        ]);

        $file = base_path().'/database/assets/img/avatars/avatar'.$number.'.png';
        $user->addMedia($file)
            ->usingName('Avatar de prueba '.$number)
            ->preservingOriginal()
            ->toMediaCollection('avatar');
    }
}
