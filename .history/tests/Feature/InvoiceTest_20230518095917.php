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
                "date",
                "due_date",
                "company_id",
                "status",
                "created_at",
                "updated_at"
            ]
        ]);
    }

    public function test_getInvoice()
    {
        //Invoice id is "5024b7dc-926d-4b22-8b47-47269dd8d5d3" and should exists in the database
        $response = $this->get('/api/invoice/5024b7dc-926d-4b22-8b47-47269dd8d5d3');

        // Assert that the response has the correct status code
        $response->assertStatus(200);

        // Assert that the response JSON contains objects with the required properties
        $response->assertJsonStructure([
            "id",
            "number",
            "date",
            "due_date",
            "company_id",
            "status",
            "created_at",
            "updated_at",
            "company",
            "products",
            "total"
        ]);
    }

    public function test_getInvoiceApprove()
    {
        //Invoice id is "5024b7dc-926d-4b22-8b47-47269dd8d5d3" and should exists in the database
        $response = $this->get('/api/invoice/approve/5024b7dc-926d-4b22-8b47-47269dd8d5d3');

        // Assert that the response has the correct status code
        $response->assertStatus(404);

        // Assert that the response JSON contains objects with the required properties
        $response->assertJsonStructure([
            "error"
        ]);
    }
}
