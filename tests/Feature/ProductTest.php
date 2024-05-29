<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Models\Product;

class ProductTest extends TestCase
{
    
    public function testProdutosSemVerificacao()
    {
        $response = $this->get('/admin/products');

        $response->assertStatus(302);
    }
    
    public function testListaProdutos()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
                         ->get('/admin/products');
        
        $response->assertStatus(200);
    }
    
    public function testCriaProduto()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
                         ->get('/admin/products/create');

        $response->assertStatus(200);
    }
    
    public function testCadastraProdutoSemAutorizacao()
    {
        $produto = (factory(Product::class)->create()->attributesToArray());
        
        $response = $this->post('/admin/products', $produto);
        
        $response->assertStatus(302);
    }
    
    public function testCadastraProdutoComAutorizacao()
    {
        $user = factory(User::class)->create();
        $produto = (factory(Product::class)->create()->attributesToArray());
        
        $response = $this->actingAs($user)->followingRedirects()
                ->post('/admin/products', $produto);
        
        $response->assertStatus(200);
    }
    
    public function testPesquisaProduto()
    {
        $user = factory(User::class)->create();
        $produto = factory(Product::class)->create();

        $response = $this->actingAs($user)
                         ->get('/admin/products/'.$produto->id);

        $response->assertStatus(200);
    }
    
}