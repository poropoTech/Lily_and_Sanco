<?php

namespace Database\Seeders;

use Database\Seeders\Response\ResponseSeeder;
use Database\Seeders\Structure\ActivitySeeder;
use Database\Seeders\Structure\CategorySeeder;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

/**
 * Class StructureSeeder.
 */
class StructureSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->disableForeignKeys();

        $this->truncate('categories');

        if (app()->environment(['local', 'testing'])) {
            $this->call(CategorySeeder::class);
            $this->call(ActivitySeeder::class);
            $this->call(ResponseSeeder::class);
        }

        $this->enableForeignKeys();
    }
}
