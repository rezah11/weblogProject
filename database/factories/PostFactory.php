<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'user_id'=>$this->fakerUserId(),
            'title'=>$this->faker->text(10),
            'summary'=>$this->faker->text(30),
            'content'=>$this->faker->text(150)
        ];
    }

    private function fakerUserId()
    {
        $userIds=User::query()->orderBy('id','asc')->pluck('id')->skip(2)->toArray();
        $rand=array_rand($userIds);
//        dd($rand , $userIds);
        return $userIds[$rand];
    }
}
