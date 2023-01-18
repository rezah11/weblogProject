<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
//        var_dump('userId is:' . $this->getUserId());
//        var_dump('postId is:' . $this->getPostId());
        return [
            'comment' => $this->faker->text(60),
            'user_id' => $this->getUserId(),
            'post_id' => $this->getPostId(),

//            'parent_id' => $this->faker->numberBetween(0,5),
        ];
    }

    private function getUserId()
    {
        $array = User::query()->orderBy('id', 'asc')->pluck('id')->skip(2)->toArray();
        $rand = array_rand($array);
//        dd(User::query()->orderBy('id','asc')->pluck('id')->skip(2)->toArray());
//        dd($userIds);
        return $array[$rand];
    }

    private function getPostId()
    {
//        dd(Post::query()->pluck('id')->toArray());
//        dd($post_id);
        $array = Post::query()->orderBy('id', 'asc')->pluck('id')->toArray();
        $rand = array_rand($array);
        return $array[$rand];
    }

}
