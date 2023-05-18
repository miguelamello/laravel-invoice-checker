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
        $response = $this->get('/api/product/list/');
        $response->assertStatus(200);
    }
}
