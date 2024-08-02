<?php

namespace Database\Factories;

use App\Domains\Responses\Models\Response;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class ResponseFactory.
 */
class ResponseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Response::class;

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
     * @return ResponseFactory
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
