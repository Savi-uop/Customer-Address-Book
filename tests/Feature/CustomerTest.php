<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_can_create_customer()
    {
        $response = $this->postJson('/api/customers', [
            'name' => 'Test Customer',
            'addresses' => ['Address 1', 'Address 2'],
        ]);

        $response->assertStatus(201);
    }


}
