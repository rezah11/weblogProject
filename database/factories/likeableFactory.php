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
//        $user=User::query()->inRandomOrder()->first();
//        $user instanceof User ? $userId=$user->id : $userId=null;
        $type=$this->faker->randomElement(['post','comment']);
        $likeId=$this->faker->unique()->numberBetween(1 , 20);
//        $userTypeLike = $this->faker->unique()->regexify("/^$userId-$likeId");
//            var_dump($this->getUser());
        return [
            'like' => $this->faker->boolean,
            'likeable_id' =>$likeId,
            'likeable_type' =>$type,
            'user_id' => $this->getUser(),
        ];
    }

    private function getUser()
    {
        $user = collect(User::query()->orderBy('id','asc')->pluck('id')->toArray());
//        dd($user->random(1)->first());
//        $rand = $user[array_rand($user)];
//        $rand = $user->random(1)->first();
//        dd($rand);
        return $user->random(1)->first();

    }
}
