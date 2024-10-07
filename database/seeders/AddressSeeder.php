<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;
use App\Models\Customer;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fetch all customers
        $customers = Customer::all();

        // Create addresses for each customer
        $customers->each(function ($customer) {
            Address::factory()->count(2)->create(['customer_id' => $customer->id]);
        });
    }
    
}
