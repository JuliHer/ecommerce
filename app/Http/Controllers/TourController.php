<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class TourController extends Controller
{
    public function index(){
        return Inertia::render('Tour', [
            'title' => "Proximas fechas"
        ]);
    }
}
