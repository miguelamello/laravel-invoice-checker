<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function test_list()
    {
        $response = $this->get('/api/product/list');
        $response->assertStatus(200);
    }

    public function test_listByName()
    {
        //Product name is "water" and should exists in the database
        $response = $this->get('/api/product/list/water');

        // Assert that the response has the correct status code
        $response->assertStatus(200);

        // Assert that the response JSON contains objects with the required properties
        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'price',
                'currency',
                'created_at',
                'updated_at',
            ]
        ]);
    }
}
