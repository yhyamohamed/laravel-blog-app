<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Post;

class CommentFactory extends Factory
{

    public function definition()
    {

        $types = [
            'App\Models\User' => User::factory(User::class),
            'App\Models\Post' => Post::factory(Post::class)
        ];
        $type = $this->faker->randomElement(array_keys($types));
        $classType = $types[$type];

        return [
            'body' => $this->faker->text(150),
            'commentable_id' => $classType,
            'commentable_type' => $type,
        ];
    }
}
