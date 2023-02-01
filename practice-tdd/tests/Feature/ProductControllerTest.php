<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;
    
    /**
    * @test
    */
    public function factory_can_create_products()
    {
        $products = $this->createProduct(rand(1,20));
        $productCount = count($products) >= 1;
        $this->assertTrue($productCount);
    }

    /**
    * @test
    */
    public function get_all_products()
    {
        $this->createProduct(rand(1,20));
        $response = $this->json('GET', '/api/products');

        $response->assertJsonStructure([
                    '*' => ['id','name','description','price','stock', 'created_at']
                ])->assertStatus(200);
    }

    /**
    * @test
    */
    public function can_create_a_product()
    {
        $response = $this->json('POST', '/api/products', [
            'name' => 'Test Product',
            'description' => 'Test Product Description',
            'price' => 1,
            'stock' => 1
        ]);

        $response->assertJsonStructure(['id','name','description','price','stock', 'created_at','updated_at'])
                ->assertStatus(201);

        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'description' => 'Test Product Description',
            'price' => 1,
            'stock' => 1
        ]);
    }

    /**
    * @test
    */
    public function can_view_a_product()
    {
        $this->createProduct();
        $response = $this->json('GET', '/api/products/1');

        $response->assertJsonStructure(['id','name','description','price','stock', 'created_at'])
                ->assertStatus(200);
    }

    /**
    * @test
    */
    public function can_update_a_product()
    {
        $this->createProduct();
        $response = $this->json('PUT', '/api/products/1', [
            'name' => 'Test Product Update',
            'description' => 'Test Product Description Update',
            'price' => 10,
            'stock' => 5
        ]);

        $response->assertJsonStructure(['id','name','description','price','stock', 'created_at','updated_at'])
                ->assertStatus(200);

        $this->assertDatabaseHas('products', [
            'name' => 'Test Product Update',
            'description' => 'Test Product Description Update',
            'price' => 10,
            'stock' => 5
        ]);
    }

    /**
    * @test
    */
    public function can_delete_a_product()
    {
        $this->createProduct();
        $response = $this->json('DELETE', '/api/products/1');

        $response->assertStatus(204);
        $this->assertDatabaseMissing('products', ['id' => 1]);
    }
}
    
