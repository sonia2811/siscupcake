<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VendaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testVisualizaCompras()
    {
        $response = $this->get('/carrinho/compras');

        $response->assertStatus(200);
    }
}
