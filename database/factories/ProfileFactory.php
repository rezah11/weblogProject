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
//        $x=1;
//        $x++;
        var_dump($this->faker->unique()->randomElement(User::query()->pluck('id')->toArray()));
//var_dump($this->getUser());
//        dd('$this->faker->unique()->numberBetween(1,13)');
//        $user=collect(User::query()->orderBy('id','asc')->pluck('id')->toArray());
//        $user=$this->faker->unique()->numberBetween(1,13);
//        var_dump($user->random(1)->unique());
//        $uesrRand=$user->random(1)->unique();
//        var_dump($this->faker->unique()->numberBetween(1,13));
        return [
            'age'=>$this->faker->numberBetween(10,60),
            'tel'=>$this->faker->buildingNumber(),
            'city'=>$this->faker->city,
            'user_id'=>$this->faker->unique()->randomElement(User::query()->pluck('id')->toArray())
        ];
    }

    private function getUser()
    {
        $user=collect(User::query()->orderBy('id','asc')->pluck('id')->toArray());
//        dd($user);
//        var_dump($user->unique()->random(1)->first());
//        return $user;
        $user = $user->map(function ($array) {
//            dd($array,collect($array)->unique()->first());
            return collect($array)->unique()->first();
        });
    }


}
