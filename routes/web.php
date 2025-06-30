<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TourController;
use App\Models\BlogPost;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::domain("ecommerce.com")->group(function (){
    Route::get('/', [HomeController::class, 'index'])->name('main');

    Route::get("/blog/{blog}", [BlogController::class, "blog"]);
    Route::get("/api/blogs", [BlogController::class, "index"]);

    Route::get('/tour', [TourController::class, 'index'])->name('tour');
    Route::get('/api/tour', [TourController::class, 'venues']);

    Route::get('/products', [ProductsController::class, 'index'])->name('products');
    Route::Get("/api/products", [ProductsController::class, 'products']);

    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/api/contact', [ContactController::class, 'store']);
});

Route::domain("admin.ecommerce.com")->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('main');

});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
