<?php

namespace Database\Seeders\Structure;

use App\Domains\Structure\Models\Category;
use Database\Seeders\Traits\DisableForeignKeys;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

/**
 * Class CategoryTableSeeder.
 */
class CategorySeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        $faker = Faker::create('es_ES');
        $fakeContent = $faker->realText(2000);

        if (app()->environment(['local', 'testing'])) {

            $category1 = Category::create([
                'name' => 'Reconectar',
                'description' => 'Los humanos solo protegemos aquello que amamos. Para cuidar de la naturaleza antes tendremos que conocerla y saber conectar con ella.',
                'content' => $fakeContent,
                'order' => 1,
                'published' => true,
                'active' => true,
            ]);

            $category2 = Category::create([
                'name' => 'Reducir',
                'description' => 'Reducir el consumo para respetar el tiempo de la regeneración natural de la tierra. Reduciendo el problema disminuimos el impacto.',
                'content' => $fakeContent,
                'order' => 2,
                'published' => true,
                'active' => true,
            ]);

            $category3 = Category::create([
                'name' => 'Reutilizar',
                'description' => 'Los residuos y objetos también merecen una segunda oportunidad. Se trata de reinventar para crear nuevas soluciones y funciones.',
                'content' => $fakeContent,
                'order' => 3,
                'published' => true,
                'active' => true,
            ]);

            $category4 = Category::create([
                'name' => 'Reciclar',
                'description' => 'Aprender a separar y clasificar correctamente nuestros residuos y desechos por un futuro y un planeta más limpio en el que vivir.',
                'content' => $fakeContent,
                'order' => 4,
                'published' => true,
                'active' => true,
            ]);

            $file = base_path().'/database/assets/img/categories/reconectar.svg';
            $category1->addMedia($file)
                ->usingName('Icono reconectar')
                ->preservingOriginal()
                ->toMediaCollection('icon');

            $file = base_path().'/database/assets/img/categories/reducir.svg';
            $category2->addMedia($file)
                ->usingName('Icono reducir')
                ->preservingOriginal()
                ->toMediaCollection('icon');

            $file = base_path().'/database/assets/img/categories/reutilizar.svg';
            $category3->addMedia($file)
                ->usingName('Icono reutilizar')
                ->preservingOriginal()
                ->toMediaCollection('icon');

            $file = base_path().'/database/assets/img/categories/reciclar.svg';
            $category4->addMedia($file)
                ->usingName('Icono reciclar')
                ->preservingOriginal()
                ->toMediaCollection('icon');

            $file = base_path().'/database/assets/img/categories/header.png';
            $category1->addMedia($file)
                ->usingName('Cabecera reconectar')
                ->preservingOriginal()
                ->toMediaCollection('image');
            $category2->addMedia($file)
                ->usingName('Cabecera reducir')
                ->preservingOriginal()
                ->toMediaCollection('image');
            $category3->addMedia($file)
                ->usingName('Cabecera reutilizar')
                ->preservingOriginal()
                ->toMediaCollection('image');
            $category4->addMedia($file)
                ->usingName('Cabecera reciclar')
                ->preservingOriginal()
                ->toMediaCollection('image');
        }

        $this->enableForeignKeys();
    }

}
