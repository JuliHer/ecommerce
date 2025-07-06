<?php

namespace App\Http\Controllers;

use App\Models\TourDate;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TourController extends Controller
{
    public function index(){
        return Inertia::render('Tour', [
            'title' => "Proximas fechas"
        ]);
    }

    public function venues(){
        return TourDate::all();
    }

    public function admin(){
        return Inertia::render('admin/Tour', [
            'Title' => "tour"
        ]);
    }

    public function new(){
        return Inertia::render('admin/NewTour', [
            'Title' => "tour"
        ]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'date' => 'required|date',
            'venue' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'tickets_url' => 'nullable|url',
            'sold_out' => 'required|boolean',
        ]);

        $tour = TourDate::create($validated);

        return $tour;
        return response()->json($tour, 201);
    }

    public function destroy($id){
        $tour = TourDate::find($id);

        if (!$tour) {
            return response()->json(['message' => 'Tour date not found.'], 404);
        }

        $tour->delete();

        return response()->json(['message' => 'Tour date deleted successfully.']);
    }
}
