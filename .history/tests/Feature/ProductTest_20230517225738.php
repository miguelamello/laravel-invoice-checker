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
        // Assert that the response has the correct status code
        $response->assertStatus(200);
    }

    public function test_listByNameExists()
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

    public function test_listByNameNotExists()
    {
        //Product name is "nameNotExists" and should not exists in the database
        $response = $this->get('/api/product/list/nameNotExists');

        // Assert that the response has the correct status code
        $response->assertStatus(200);

        // Assert that the response contains an empty array
        $response->assertExactJson([]);
    }

    public function test_getProduct()
    {
        //Product id is "3fdeb0a2-ccb6-4b5a-8014-400350758c77" and should exists in the database
        $response = $this->get('/api/product/3fdeb0a2-ccb6-4b5a-8014-400350758c77');

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
