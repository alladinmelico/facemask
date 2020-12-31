<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sender_id = User::inRandomOrder()->first()->getKey();
        $receiver_id = User::inRandomOrder()->first()->getKey();
        $chat_id = Chat::inRandomOrder()->first()->getKey();

        $existing = true;
        while($existing){
            $message = Message::where('chat_id',$chat_id)->get();
            if($message->isEmpty()){
                $existing = false;
                break;
            }
               foreach ($message as $key => $value) {
                    if(($value->sender_id===$sender_id) && ($value->receiver_id===$receiver_id)){
                        $existing = false;
                    } else{
                        $chat_id = Chat::inRandomOrder()->first()->getKey();
                        $existing = true;
                        break;
                    }
                }

        }
        //TODO: Fix the algo on seeding multiple messages
        return [
            'sender_id' => $sender_id,
            'receiver_id' => $receiver_id,
            'message' => $this->faker->sentence,
            'chat_id'=> $chat_id
        ];
    }
}