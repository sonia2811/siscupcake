<?php

Route::prefix('admin')->namespace('Admin')->middleware('auth')
        ->group(function(){
    
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
    Route::get('/', 'PlanController@index')->name('admin.index');
    
});

/**
* Site Routes
*/

Route::get('/', 'Site\SiteController@index')->name('site.home');

/**
* Auth Routes
*/
Auth::routes();