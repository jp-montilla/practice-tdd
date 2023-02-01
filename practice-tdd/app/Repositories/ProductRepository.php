<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function getAllProducts()
    {
        $products = Product::select('id','name','description','price','stock', 'created_at')->get();

        return $products;
    }

    public function createProduct($request)
    {
        $product = Product::create([
            'name'  => $request->get('name'),
            'description'  =>$request->get('description'),
            'price' => $request->get('price'),
            'stock' => $request->get('stock')
        ]);

        return $product;
    }

    public function getProduct($id)
    {
        $product = Product::select('id','name','description','price','stock', 'created_at')
                    ->where('id', $id)
                    ->first();

        return $product;
    }

    public function updateProduct($id,$request)
    {
        $product = Product::findOrfail($id);

        $product->update([
            'name'  => $request->get('name'),
            'description'  =>$request->get('description'),
            'price' => $request->get('price'),
            'stock' => $request->get('stock')
        ]);

        return $product;
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrfail($id);

        $product->delete();
        
        return $product;
    }
}
