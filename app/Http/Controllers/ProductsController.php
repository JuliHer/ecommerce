<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductsController extends Controller
{
    public function index(){
        return Inertia::render('products', [
            "title" => "Catálogo"
        ]);
    }

    public function products(){
        return Product::all('id', 'name', 'price', 'image');
    }
}
