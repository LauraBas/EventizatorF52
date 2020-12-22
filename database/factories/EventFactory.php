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
            'description' => $this->faker->text,
            'capacity' => $this->faker->numberBetween(1, 500),
            'requirements' => $this->faker->text, 
            'image' => $this->faker->url, 
            'link' => $this->faker->url, 
        ];
    }
}
