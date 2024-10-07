<?php

namespace Database\Factories;

use App\Models\Address;

use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{

    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'address_number' => $this->faker->buildingNumber,
            'address_street' => $this->faker->streetName,
            'address_city' => $this->faker->city,
            'customer_id' => null, // This will be set when creating addresses within the seeder
        ];
    }
}
