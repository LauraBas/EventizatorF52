<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'date' => $this->faker->date,
            'time' => $this->faker->time,
            'description' => $this->faker->sentence,
            'capacity' => $this->faker->numberBetween(1, 500),
            'participants' => $this->faker->numberBetween(0, 1),
            'requirements' => $this->faker->sentence,
            'image' => $this->faker->url,
            'link' => $this->faker->url,
            'isHighlighted' => $this->faker->boolean()
        ];
    }
}
