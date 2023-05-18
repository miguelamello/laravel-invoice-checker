<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    public function test_list()
    {
        //Return a list of all companies limited to 100
        $response = $this->get('/api/company/list');
        // Assert that the response has the correct status code
        $response->assertStatus(200);
    }

    public function test_listByNameExists()
    {
        //Company name is "Schulist" and should exists in the database
        $response = $this->get('/api/product/list/Schulist');

        // Assert that the response has the correct status code
        $response->assertStatus(200);

        // Assert that the response JSON contains objects with the required properties
        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'street',
                'city',
                ''
                'created_at',
                'updated_at',
            ]
        ]);
    }

    public function test_listByNameNotExists()
    {
        //Company name is "nameNotExists" and should not exists in the database
        $response = $this->get('/api/product/list/nameNotExists');

        // Assert that the response has the correct status code
        $response->assertStatus(200);

        // Assert that the response contains an empty array
        $response->assertExactJson([]);
    }

    public function test_getCompany()
    {
        //Company id is "0f53c871-d271-436c-86bc-e63e60454f8b" and should exists in the database
        $response = $this->get('/api/company/0f53c871-d271-436c-86bc-e63e60454f8b');

        // Assert that the response has the correct status code
        $response->assertStatus(200);

        // Assert that the response JSON contains objects with the required properties
        $response->assertJsonStructure([
            'id',
            'name',
            'price',
            'currency',
            'created_at',
            'updated_at',
        ]);
    }
}
