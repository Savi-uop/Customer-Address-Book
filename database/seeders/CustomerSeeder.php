<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Address;
use App\Models\Project;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 10 customers with addresses
        Customer::factory()->count(10)->create()->each(function ($customer) {
            // For each customer, create 2 addresses
            Address::factory()->count(2)->create([
                'customer_id' => $customer->id,
            ]);
        });
    }
}
