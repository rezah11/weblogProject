<?php

namespace Database\Factories;

use App\Models\Likeable;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class likeableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user=User::query()->inRandomOrder()->first();
        $user instanceof User ? $userId=$user->id : $userId=null;
        $type=$this->faker->randomElement(['post','comment']);
        $likeId=$this->faker->numberBetween(1 , 20);
        $userTypeLike = $this->faker->unique()->regexify("/^$userId-$type-$likeId-[a-z]{2}");

        return [
            'like' => $this->faker->boolean,
            'likeable_id' =>$likeId,
            'likeable_type' =>$type,
            'user_id' => $userId,
        ];
    }

    private function getUser()
    {
        $user = User::query()->pluck('id')->toArray();
        $rand = $user[array_rand($user)];
        return $rand;

    }
}
