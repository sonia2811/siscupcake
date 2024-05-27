<?php

/**
 * Auth Routes
*/
Auth::routes();

/**
 * Site Routes
*/

Route::get('/', 'Site\SiteController@index')->name('site.home');
Route::get('detalhesproduto/{produtoId}', 'Site\SiteController@visualizarDetalhesProduto')->name('site.detalhesproduto');

/**
 * Routes Carrinho Compras
*/
Route::resource('carrinhocompras', 'CarrinhoCompraController');
Route::get('/carrinho', 'Site\CarrinhoCompraController@index')->name('carrinho.index');
//Route::get('/carrinho/adicionar', function() {
//    return redirect()->route('index');
//});
//Route::post('/carrinho/adicionar', 'Site\CarrinhoCompraController@store')->name('carrinho.adicionar');
//Route::delete('/carrinho/remover', 'CarrinhoController@remover')->name('carrinho.remover');
Route::post('/carrinho/concluir', 'CarrinhoController@concluir')->name('carrinho.concluir');
Route::post('/carrinho/cancelar', 'CarrinhoController@cancelar')->name('carrinho.cancelar');
Route::post('/carrinho/desconto', 'CarrinhoController@desconto')->name('carrinho.desconto');

/**
 * Routes Vendas
*/
Route::get('/carrinho/compras', 'Site\VendaController@visualizarCompras')->name('carrinho.compras');

Route::prefix('carrinho')->middleware('auth')->group(function(){
    Route::post('adicionar', 'Site\CarrinhoCompraController@store')->name('carrinho.adicionar');
    Route::delete('subtrair', 'Site\CarrinhoCompraController@subtrair')->name('carrinho.subtrair');
    Route::delete('remover', 'Site\CarrinhoCompraController@remover')->name('carrinho.remover');
});

Route::prefix('admin')->namespace('Admin')->middleware('auth')
        ->group(function(){
    
    /**
     * Routes Cupom Desconto
    */
    Route::any('cuponsdesconto/search', 'CupomDescontoController@search')->name('cuponsdesconto.search');
    Route::resource('cuponsdesconto', 'CupomDescontoController');
    
    /**
     * Routes Formas Envio
    */
    Route::any('formasenvio/search', 'FormaEnvioController@search')->name('formasenvio.search');
    Route::resource('formasenvio', 'FormaEnvioController');
    
    /**
     * Routes Formas Pagamento
     */
    Route::any('formaspagamento/search', 'FormaPagamentoController@search')->name('formaspagamento.search');
    Route::resource('formaspagamento', 'FormaPagamentoController');
            
    /**
     * Routes Product x Category
    */
    Route::get('product/{id}/category/{idCategory}/detach', 'CategoryProductController@detachCategoryProduct')->name('product.category.detach');
    Route::post('product/{id}/categories', 'CategoryProductController@attachCategoriesProduct')->name('product.categories.attach');
    Route::any('product/{id}/categories/search', 'CategoryProductController@filterCategoriesAvailable')->name('product.categories.available.search');
    Route::get('product/{id}/categories/create', 'CategoryProductController@categoriesAvailable')->name('product.categories.available');
    Route::get('product/{id}/categories', 'CategoryProductController@categories')->name('product.categories');
            
    /**
     * Routes Products
     */
    Route::any('products/search', 'ProductController@search')->name('products.search');
    Route::resource('products', 'ProductController'); 
            
    /**
     * Routes Categories
     */
    Route::any('categories/search', 'CategoryController@search')->name('categories.search');
    Route::resource('categories', 'CategoryController');       
     
    /**
     * Routes Users
     */
    Route::any('users/search', 'UserController@search')->name('users.search');
    Route::resource('users', 'UserController');
            
    /**
     * Routes Permissions
     */
    Route::any('permissions/search', 'ACL\PermissionController@search')->name('permissions.search');
    Route::resource('permissions', 'ACL\PermissionController');
    
    /**
     * Routes Profiles
     */
    Route::any('profiles/search', 'ACL\ProfileController@search')->name('profiles.search');
    Route::resource('profiles', 'ACL\ProfileController');
    
    /*
     * Home Dashboard
     */
    Route::get('/', 'DashboardController@index')->name('admin.index');
    
});