<?php

namespace Database\Seeders\Response;

use App\Domains\Responses\Models\Response;
use Database\Seeders\Traits\DisableForeignKeys;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

/**
 * Class ResponseTableSeeder.
 */
class ResponseSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        if (app()->environment(['local', 'testing'])) {
            $this->addTestResponse(1, 1, 6);
            $this->addTestResponse(2, 1, 7);
            $this->addTestResponse(3, 1, 8);
            $this->addTestResponse(4, 1, 9);
            $this->addTestResponse(5, 2, 6);
            $this->addTestResponse(6, 2, 7);
            $this->addTestResponse(7, 2, 8);
            $this->addTestResponse(8, 2, 9);

            $this->addTestResponse(1, 13, 6);
            $this->addTestResponse(2, 13, 7);
            $this->addTestResponse(3, 13, 8);
            $this->addTestResponse(4, 13, 9);
            $this->addTestResponse(5, 14, 6);
            $this->addTestResponse(6, 14, 7);
            $this->addTestResponse(7, 14, 8);
            $this->addTestResponse(8, 14, 9);

            $this->addTestResponse(1, 21, 6);
            $this->addTestResponse(2, 21, 7);
            $this->addTestResponse(3, 21, 8);
            $this->addTestResponse(4, 21, 9);
            $this->addTestResponse(5, 24, 6);
            $this->addTestResponse(6, 24, 7);
            $this->addTestResponse(7, 24, 8);
            $this->addTestResponse(8, 24, 9);

        }

        $this->enableForeignKeys();

        $this->call(ResponseCommentSeeder::class);
    }

    private function addTestResponse($number, $activity_id, $user_id)
    {
        $faker = Faker::create('es_ES');
        $fakeContent = $faker->realText(200);
        $response = Response::create([
            'activity_id' => $activity_id,
            'type_id' => Response::TYPE_T_I,
            'challenge' => 'collective',
            'user_id' => $user_id,
            'content' => $fakeContent,

        ]);

        $file = base_path().'/database/assets/img/activities/card'.$number.'.jpg';
        $response->addMedia($file)
            ->usingName('Imagen de prueba de respuesta'.$number)
            ->preservingOriginal()
            ->toMediaCollection('image');
    }
}
