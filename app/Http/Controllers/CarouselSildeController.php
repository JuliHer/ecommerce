<?php

namespace App\Http\Controllers;

use App\Models\CarouselSlide;
use Illuminate\Http\Request;

class CarouselSildeController extends Controller
{
    public function index(){
        return CarouselSlide::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|string', // Puedes usar almacenamiento de Laravel si subes imágenes
            'cta_text' => 'nullable|string',
            'cta_url' => 'nullable|url',
            'active' => 'boolean',
        ]);

        $slide = CarouselSlide::create($validated);

        return response()->json($slide, 201);
    }

    public function update(Request $request, CarouselSlide $carouselSlide)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'sometimes|required|string',
            'cta_text' => 'nullable|string',
            'cta_url' => 'nullable|url',
            'active' => 'boolean',
        ]);

        $carouselSlide->update($validated);

        return response()->json($carouselSlide);
    }

    public function destroy(CarouselSlide $carouselSlide)
    {
        $carouselSlide->delete();

        return response()->json(null, 204);
    }
}
