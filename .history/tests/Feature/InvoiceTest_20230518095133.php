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
            "company_id": "8dedea38-355f-46df-8fe7-3aaa143bba50",
            "status": "rejected",
            "created_at": "2023-05-16T11:39:57.000000Z",
            "updated_at": "2023-05-16T11:39:57.000000Z",
            "company": {
                "id": "8dedea38-355f-46df-8fe7-3aaa143bba50",
                "name": "Bashirian, Jenkins and Bode",
                "street": "4723 Abshire Manors",
                "city": "Buckridgeshire",
                "zip": "48971-6673",
                "phone": "314.954.5342",
                "email": "oward@example.net",
                "created_at": "2023-05-16T11:39:57.000000Z",
                "updated_at": "2023-05-16T11:39:57.000000Z"
            },
            "products": [
                {
                "id": "ec608e82-41ca-4c23-8eba-e06af027afa1",
                "name": "trousers",
                "price": 3781637,
                "currency": "usd",
                "created_at": "2023-05-16T11:39:57.000000Z",
                "updated_at": "2023-05-16T11:39:57.000000Z",
                "quantity": 70,
                "total": "2647145.90"
                },
                {
                "id": "e64bc59d-2c7b-4170-b944-77726c033416",
                "name": "pepsi",
                "price": 232524,
                "currency": "usd",
                "created_at": "2023-05-16T11:39:57.000000Z",
                "updated_at": "2023-05-16T11:39:57.000000Z",
                "quantity": 56,
                "total": "130213.44"
                },
                {
                "id": "dcb16c83-ccc1-419d-978b-3cfd2a652c1e",
                "name": "pencil",
                "price": 9368964,
                "currency": "usd",
                "created_at": "2023-05-16T11:39:57.000000Z",
                "updated_at": "2023-05-16T11:39:57.000000Z",
                "quantity": 74,
                "total": "6933033.36"
                }
            ],
            "total": "9710392.70"
        ]);
    }
}
