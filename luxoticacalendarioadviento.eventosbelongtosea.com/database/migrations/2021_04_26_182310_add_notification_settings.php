<?php

use Illuminate\Database\Migrations\Migration;

class AddNotificationSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('system_settings')->insert(
            [
                'key' => 'app.notifications.new-response-comment',
                'value' => '0',
                'description' => 'Notificación enviada al usuario informando que han comentado sus desafíos',
            ]
        );
        DB::table('system_settings')->insert(
            [
                'key' => 'app.notifications.opt-in',
                'value' => '0',
                'description' => 'Los usuarios deciden que notificaciones reciben',
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('system_settings')->where('key', 'app.notifications.new-response-comment')->delete();
        DB::table('system_settings')->where('key', 'app.notifications.opt-in')->delete();
    }
}
