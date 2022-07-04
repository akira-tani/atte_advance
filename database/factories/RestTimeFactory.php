<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RestTimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'work_time_id' => '',
            'rest_start' => '14:53:55',
        ];
    }
}
