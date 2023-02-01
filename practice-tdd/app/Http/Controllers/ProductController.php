<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    public function index(ProductRepository $productRepository)
    {
        $response = $productRepository->getAllProducts();

        return response()->json($response);
    }

    public function store(ProductRequest $request, ProductRepository $productRepository)
    {
        $response = $productRepository->createProduct($request);

        return response()->json($response, 201);
    }

    public function show($id, ProductRepository $productRepository)
    {
        $response = $productRepository->getProduct($id);

        return response()->json($response);
    }

    public function update($id, ProductRequest $request, ProductRepository $productRepository)
    {
        $response = $productRepository->updateProduct($id, $request);

        return response()->json($response);
    }

    public function delete($id, ProductRepository $productRepository)
    {
        $response = $productRepository->deleteProduct($id);

        return response()->json($response, 204);
    }
}
