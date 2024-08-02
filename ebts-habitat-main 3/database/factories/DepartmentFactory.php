<?php

namespace Database\Factories;

use App\Domains\Auth\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class DepartmentFactory.
 */
class DepartmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Department::class;

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
     * @return DepartmentFactory
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
