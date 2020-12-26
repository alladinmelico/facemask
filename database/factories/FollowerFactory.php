<?php

namespace Database\Factories;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FollowerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Follower::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user_id = User::inRandomOrder()->first()->getKey();
        $follower_id = User::inRandomOrder()->first()->getKey();

        while ($user_id == $follower_id) {
            $follower_id = User::inRandomOrder()->first()->getKey();
        }

        return [
            'user_id' => $user_id,
            'user_follower_id' => $follower_id
        ];
    }
}