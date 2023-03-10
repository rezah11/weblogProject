<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $image=1;
        return [
            'image_url'=>'download.png',
            'post_id'=>$image++
        ];
    }
}
