<?php

namespace Database\Seeders;

use Database\Seeders\Configuration\System\SystemConfigurationSeeder;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder.
 */
class DatabaseSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Seed the application's database.
     */
    public function run()
    {
        Model::unguard();

        $this->truncateMultiple([
            'activity_log',
            'failed_jobs',
            'system_settings',
        ]);

        $this->call(SystemConfigurationSeeder::class);
        $this->call(AuthSeeder::class);
        $this->call(StructureSeeder::class);

//        $this->call(AnnouncementSeeder::class);

        Model::reguard();
    }
}
