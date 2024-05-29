<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class SiteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSite()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    
    public function testDetalhesProdutoSite()
    {
        $produto = factory(Product::class)->create();
        
        $response = $this->get('detalhesproduto/' . $produto->id);
        
        $response->assertStatus(200);
    }
}
