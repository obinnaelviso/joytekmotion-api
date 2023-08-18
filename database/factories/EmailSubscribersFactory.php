<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\EmailSubscribers;

class EmailSubscribersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmailSubscribers::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'email' => $this->faker->safeEmail,
            'status' => $this->faker->randomElement(["pending","subscribed","unsubscribed"]),
        ];
    }
}
