<?php

namespace App\Http\Controllers;

use App\Models\CarouselSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class CarouselSildeController extends Controller
{
    public function index(){
        return CarouselSlide::where('active', true)->get();
    }

    public function index_admin(){
        return CarouselSlide::all();
    }

    public function admin(){
        return Inertia::render('admin/Slides', [
            "title" => "Slide"
        ]);
    }

    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'cta_text' => 'nullable|string',
            'cta_url' => 'nullable|url',
            'active' => 'boolean',
        ]);

        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('slides', 'public'); // almacena en storage/app/public/slides     
            $validated['image'] = Storage::url($path); // genera la URL pública, ej: /storage/slides/imagen.jpg
        }

        
        $slide = CarouselSlide::create($validated);

        return response()->json($slide, 201);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:carousel_slides,id',
        ]);

        
        $carouselSlide = CarouselSlide::findOrFail($request->id);

        $carouselSlide->active = !$carouselSlide->active;

        $carouselSlide->save();

        return response()->json("",200);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:carousel_slides,id',
        ]);

        
        $carouselSlide = CarouselSlide::findOrFail($request->id);
        
        $carouselSlide->delete();

        return response()->json(null, 204);
    }
}
