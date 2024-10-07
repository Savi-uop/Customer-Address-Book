<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Customer::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'company' => $this->faker->company,
            'contact_phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'country' => $this->faker->country,
        ];
        
    }
}
