<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Chat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sender_id = User::inRandomOrder()->first()->getKey();
        $receiver_id = User::inRandomOrder()->first()->getKey();
        while($sender_id == $receiver_id){
            $receiver_id = User::inRandomOrder()->first()->getKey();
            if(Chat::where([['sender_id','=',$sender_id], ['receiver_id','=',$receiver_id]])->get()->isNotEmpty()){
                $receiver_id = User::inRandomOrder()->first()->getKey();
            }
        }

        return [
            'sender_id' => $sender_id,
            'receiver_id' => $receiver_id
        ];
    }
}