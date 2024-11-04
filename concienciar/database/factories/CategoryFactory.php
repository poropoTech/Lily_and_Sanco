<?php

namespace Database\Factories;

use App\Domains\Structure\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class CategoryFactory.
 */
class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'order' => 0,
            'published' => true,
            'active' => true,
        ];
    }

    /**
     * @return CategoryFactory
     */
    public function published($state)
    {
        return $this->state(function (array $attributes, $state) {
            return [
                'published' => $state,
            ];
        });
    }
}
