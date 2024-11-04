<?php

namespace Database\Factories;

use App\Domains\Structure\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class ActivityFactory.
 */
class ActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Activity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'content' => $this->faker->text,
            'order' => 0,
            'published' => false,
            'active' => true,
        ];
    }

    /**
     * @return ActivityFactory
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
