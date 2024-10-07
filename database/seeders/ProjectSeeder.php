<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Customer;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all customer IDs
        $customers = Customer::all()->pluck('id')->toArray();

        // Create 10 projects and associate each with random customers
        Project::factory()->count(10)->create()->each(function ($project) use ($customers) {
            // Attach 1 to 3 random customers to each project
            $project->customers()->sync(array_rand(array_flip($customers), rand(1, 3)));
        });
    }
    
}
