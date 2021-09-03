<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    function addProduct(Request $req){
        $product = new Product;
        $product -> name = $req -> input('name');
        $product -> price = $req -> input('price');
        $product -> description = $req -> input('description');
        $product -> file_path = $req -> file('file_path') -> store('products');
        $product -> save();
        return $product;
    }

    function listProduct(){
        return Product::all();
    }

    function deleteProduct($id){
        $result = Product::where('id', $id) -> delete();
        if ($result) {
            # code...
            return ['result'=> "product has been deleted"];
        }
        else{
            return ['result'=>"Operation Failed"];
        }
    }

    function getData($id){
        return Product::find($id);
    }

    function updateProduct($id, Request $req){
        
        $product = Product::find($id);
        $product -> name = $req -> input('name');
        $product -> price = $req -> input('price');
        $product -> description = $req -> input('description');
        if ($req -> file('file_path')) {
            $product -> file_path = $req -> file('file_path') -> store('products');
        }
        $product -> save();
        return $product;
    }

    function searchProduct($key){

        return Product::where('name','LIKE',"%$key%")->get();
    }
}
