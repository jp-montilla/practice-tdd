<?php

namespace Tests;

use App\Models\Product;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function createProduct($count=1)
    {
        $product = Product::factory()->count($count)->create();
        return $product;
    }
}
