<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    public function test_list()
    {
        //Return a list of recent invoices limited to 100
        $response = $this->get('/api/invoice/list');
        // Assert that the response has the correct status code
        $response->assertStatus(200);
    }

    public function test_listByStatus()
    {
        //Return a list of invoices with status "approved | rejected | draft" limited to 100
        $response = $this->get('/api/product/list/appoved');

        // Assert that the response has the correct status code
        $response->assertStatus(200);

        // Assert that the response JSON contains objects with the required properties
        $response->assertJsonStructure([
            '*' => [
                "id",
                "number",
                "date,
                "due_date": "1971-08-17",
                "company_id": "d09eba0c-df4c-4998-a697-8164412fca6d",
                "status": "rejected",
                "created_at": "2023-05-16T11:39:57.000000Z",
                "updated_at": "2023-05-16T11:39:57.000000Z"
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
            'id',
            'name',
            'price',
            'currency',
            'created_at',
            'updated_at',
        ]);
    }
}
