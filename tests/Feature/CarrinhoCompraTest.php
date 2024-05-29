<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Models\Product;

class CarrinhoCompraTest extends TestCase
{
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testVisualizaCarrinhoCompra()
    {
        $user = factory(User::class)->create();
        
        $response = $this->actingAs($user)
                         ->get('/carrinho');
        
        $response->assertStatus(200);
    }
    
    public function testAdicionaProdutoNoCarrinho()
    {
        $user = factory(User::class)->create();
        $produto = (factory(Product::class)->create()->attributesToArray());
        
        $response = $this->actingAs($user)->followingRedirects()
                ->post('/carrinho/adicionar', $produto);

        $response->assertStatus(200);
    }
    
    public function testRemoveProdutoDoCarrinho()
    {
        $user = factory(User::class)->create();
        $dados = [
            'pedido_id' => 9,
            'produto_id' => 161
        ];
        
        $response = $this->actingAs($user)->followingRedirects()
                ->delete('/carrinho/remover', $dados);
        
        $response->assertStatus(200);
    }
    
}