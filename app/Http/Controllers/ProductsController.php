<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductsController extends Controller
{
    public function saveProduct(Request $request)
    {
        $request->validate([
            'productName' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);


        $productData['id'] = substr(md5(microtime()), 0, 10);
    
        $productData = [
            'productName' => $request->productName,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'datetime' => now()->toDateTimeString(),
        ];
    
        $products = [];
        if (Storage::exists('products.json')) {
            $products = json_decode(Storage::get('products.json'), true);
        }
        $products[] = $productData;
        Storage::put('products.json', json_encode($products));
    
        $totalValue = 0;
        foreach ($products as $product) {
            $totalValue += $product['quantity'] * $product['price'];
        }
    
        $table = '';
        foreach ($products as $product) {
            $table .= '<tr>';
            $table .= '<td>' . $product['productName'] . '</td>';
            $table .= '<td>' . $product['quantity'] . '</td>';
            $table .= '<td>' . $product['price'] . '</td>';
            $table .= '<td>' . $product['datetime'] . '</td>';
            $table .= '<td>' . ($product['quantity'] * $product['price']) . '</td>';
            $table .= '<td><button class="btn btn-primary">Edit</button></td>';
            $table .= '</tr>';
        }
    
        return response()->json([
            'table' => $table,
            'totalValue' => $totalValue,
        ]);
    }

    public function showForm()
    {

        $products = [];
        if (Storage::exists('products.json')) {
            $products = json_decode(Storage::get('products.json'), true);
        }


        $totalValue = 0;
        foreach ($products as $product) {
            $totalValue += $product['quantity'] * $product['price'];
        }

        return view('products', compact('products', 'totalValue'));
    }
    

    public function updateProduct(Request $request, $id)
    {

        $products = [];
        if (Storage::exists('products.json')) {
            $products = json_decode(Storage::get('products.json'), true);
        }


        $products[$id]['productName'] = $request->productName;
        $products[$id]['quantity'] = $request->quantity;
        $products[$id]['price'] = $request->price;


        Storage::put('products.json', json_encode($products));


        return response()->json(['message' => 'Product updated successfully']);
    }
}
