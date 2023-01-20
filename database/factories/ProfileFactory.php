<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'age'=>$this->faker->numberBetween(10,60),
            'tel'=>$this->faker->buildingNumber,
            'city'=>$this->faker->city,
            'user_id'=>$this->faker->unique()->numberBetween(1,13),
        ];
    }


}
