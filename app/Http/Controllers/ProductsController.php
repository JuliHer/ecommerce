<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Str;

use function Pest\Laravel\json;

class ProductsController extends Controller
{
    public function index(){
        return Inertia::render('products', [
            "title" => "Catálogo"
        ]);
    }

    public function products(){
        $products = Product::with(['category', 'tax', 'variants'])
                    ->get()
                    ->map(function ($product) {
                        $taxMultiplier = 1 + (($product->tax?->percentage ?? 0) / 100);
                        $product->price_with_tax = $product->price * $taxMultiplier;

                        // Calcular el stock total sumando variantes
                        $product->total_stock = $product->variants->sum('stock');

                        return $product;
                    });


        return $products;
    }

    public function admin_products(){
        $products = Product::with(['category', 'tax', 'variants'])
                    ->get()
                    ->map(function ($product) {
                        $taxMultiplier = 1 + (($product->tax?->percentage ?? 0) / 100);
                        $product->price_with_tax = $product->price * $taxMultiplier;

                        // Calcular el stock total sumando variantes
                        $product->total_stock = $product->variants->sum('stock');

                        return $product;
                    });


        return $products;

    }

    public function admin_product($id){
        $products = Product::with(['category', 'tax', 'provider','images', 'variants'])
                    ->findOrFail($id);

        return $products;

    }

    public function admin(){
        return Inertia::render("admin/Products");
    }

    public function edit($id){
        return Inertia::render("admin/EditProduct", [
            'productId' => $id
        ]);
    }

    public function delete($id){
      

        
        $product = Product::findOrFail($id);
        
        $product->delete();

        return response()->json(null, 204);

    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'price' => 'required|numeric|min:0',
            'cost' => 'required|numeric|min:0',
            'variants' => 'nullable|array',
            'variants.*.id' => 'nullable|exists:variants,id',
            'variants.*.name' => 'required|string',
            'variants.*.sku' => 'nullable|string',
            'variants.*.price_modifier' => 'nullable|numeric',
            'variants.*.stock' => 'nullable|numeric',
            'variants.*.weight_modifier' => 'nullable|numeric',
        ]);

        $product = Product::findOrFail($id);

        // Actualizar precio y costo
        $product->price = $validated['price'];
        $product->cost = $validated['cost'];
        $product->save();

        // Actualizar variantes
        if (isset($validated['variants'])) {
            // Eliminar todas las variantes existentes
            $product->variants()->delete();

            // Volver a crear variantes con los datos del frontend
            foreach ($validated['variants'] as $variant) {
                $product->variants()->create([
                    'name' => $variant['name'],
                    'sku' => $variant['sku'] ?? '',
                    'price_modifier' => $variant['price_modifier'] ?? 0,
                    'stock' => $variant['stock'] ?? 0,
                    'weight_modifier' => $variant['weight_modifier'] ?? 0,
                ]);
            }
        }

        return response()->json(['message' => 'Producto actualizado correctamente']);
    }


    public function new(){
        return Inertia::render("admin/Product");
    }

    public function store(Request $request){
        

        $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric',
                'cost' => 'required|numeric',
                'weight' => 'nullable|numeric',
                'provider_id' => 'nullable|exists:providers,id',
                'category_id' => 'nullable|exists:categories,id',
                'tax_id' => 'nullable|exists:taxes,id',
                'images.*' => 'image|max:5120', // Valida cada imagen (5MB máximo)
                "variants" => 'nullable'
            ]);

        // Crear el producto principal
        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'cost' => $validated['cost'],
            'weight' => $validated['weight'] ?? null,
            'category_id' => $validated['category_id'] ?? null,
            'tax_id' => $validated['tax_id'] ?? null,
            'provider_id' => $validated['provider_id'] ?? null,
        ]);

        // Guardar imágenes si existen
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $path = $imageFile->store('products', 'public');
                Image::create([
                    'product_id' => $product->id,
                    'URL' => Storage::url($path), // genera la URL pública
                ]);
            }
        }

        // Guardar variantes si existen
        if (!empty($validated['variants'])) {
            
            $variants = json_decode($validated['variants'], true);
            if (is_array($variants)) {
                foreach ($variants as $variant) {
                    $product->variants()->create([
                        'name' => $variant['name'] ?? '',
                        'sku' => $variant['sku'] ?? '',
                        'price_modifier' => $variant['price_modifier'] ?? 0,
                        'stock' => $variant['stock'] ?? 0,
                        'weight_modifier' => $variant['weight_modifier'] ?? 0,
                    ]);
                }
            }
        }

        return response()->json($product->load(['images', 'variants']), 201);




    }

    public function categories(){
        return Category::all();
    }

    public function store_category(Request $request){
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "description" => "nullable|string"
        ]);

        $validated["slug"] = Str::slug($validated["name"]);

        $category = Category::create($validated);

        return response()->json($category, 201);
    }

    public function taxes(){
        return Tax::all();
    }

    public function store_tax(Request $request){
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "description" => "nullable|string",
            "percentage" => "required|integer"
        ]);

        $tax = Tax::create($validated);

        return response()->json($tax, 201);
    }

    public function providers(){
        return Provider::all();
    }

    public function store_provider(Request $request){
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "contact_email" => "required|string",
            "phone" => "nullable|string",
            "address" => "nullable|string"
        ]);

        $provider = Provider::create($validated);

        return response()->json($provider, 201);
    }

}
