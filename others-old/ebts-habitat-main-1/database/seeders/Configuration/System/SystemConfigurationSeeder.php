<?php

namespace Database\Seeders\Configuration\System;

use App\Domains\Configuration\System\Models\SystemSetting;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

/**
 * Class SystemConfigurationTableSeeder.
 */
class SystemConfigurationSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        SystemSetting::create(['key' => 'system.design.frontend', 'value' => '',
                'description' => 'Reglas CSS para la parte frontend',
            ]);
        SystemSetting::create(['key' => 'system.design.backend', 'value' => '',
                'description' => 'Reglas CSS para la parte backend',
            ]);

        SystemSetting::create(['key' => 'app.notifications.activity-published', 'value' => false,
            'description' => 'Notificación enviada al usuario informando que se han publicado desafíos',
        ]);

        SystemSetting::create(['key' => 'app.notifications.incomplete-activities', 'value' => false,
            'description' => 'Notificación enviada al usuario informando que tiene desafíos incompletos.',
        ]);

        SystemSetting::create(['key' => 'app.notifications.incomplete-activities-cron', 'value' => false,
            'description' => 'Expresión Cron indicando la periodicidad de la notificación de desafíos incompletos.',
        ]);

        SystemSetting::create(['key' => 'app.responses.verification-required', 'value' => false,
            'description' => 'Las respuestas a actividades de los usuario tiene que ser aprobadas manualmente para hacerse públicas',
            ]);
        SystemSetting::create(['key' => 'app.carousel.items', 'value' => 10,
            'description' => 'Número de respuestas presentadas en el carrusel de la página de inicio',
            ]);
        SystemSetting::create(['key' => 'app.comments.enabled', 'value' => true,
            'description' => 'Sistema de comentarios para usuarios activado/desactivado',
            ]);
        SystemSetting::create(['key' => 'app.comments.verification-required', 'value' => false,
            'description' => 'Los comentarios a respuestas de los usuario tienen que ser aprobados manualmente para hacerse públicos',
            ]);
        SystemSetting::create(['key' => 'app.responses.wall-comments-per-page', 'value' => 20,
            'description' => 'Número de comentarios por página en el modal de comentarios de respuestas.',
        ]);
        SystemSetting::create(['key' => 'app.activity.wall-responses-per-page', 'value' => 6,
            'description' => 'Número de respuestas por página en el scroll infinito',
        ]);
        SystemSetting::create(['key' => 'app.wall.responses-per-page', 'value' => 6,
            'description' => 'Número de respuestas por página en el scroll infinito',
        ]);
        SystemSetting::create(['key' => 'app.category.wall-activities-per-page', 'value' => 6,
            'description' => 'Número de actividades por página en el scroll infinito',
        ]);
        SystemSetting::create(['key' => 'app.notifications.new-response-comment', 'value' => false,
            'description' => 'Notificación enviada al usuario informando que han comentado sus desafíos',
        ]);
        SystemSetting::create(['key' => 'app.notifications.opt-in', 'value' => false,
            'description' => 'Los usuarios deciden que notificaciones reciben',
        ]);

        if (app()->environment(['local', 'testing'])) {
        }

        $this->enableForeignKeys();
    }
}
