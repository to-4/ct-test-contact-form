<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name'  => $this->faker->lastName(),
            'gender'     => $this->faker->numberBetween(0, 2), // 0/1/2 など
            'email'      => $this->faker->unique()->safeEmail(),
            'tel'        => $this->faker->phoneNumber(),
            'address'    => $this->faker->address(),
            'building'   => $this->faker->optional()->secondaryAddress(),
            'detail'     => $this->faker->realText(120),
            // 'category_id' は Seeder で割当
        ];
    }
}
