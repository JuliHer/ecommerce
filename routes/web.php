<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CarouselSildeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TourController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\CarouselSlide;
use App\Models\TourDate;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/login', [LoginController::class, 'login'])->name("login");
Route::get('/signup', [LoginController::class, 'signup'])->name("signup");
Route::post('/api/login', [LoginController::class, 'validate']);
Route::post('/api/register', [LoginController::class, 'register']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::domain("admin.ecommerce.com")->group(function () {
    
    Route::middleware(['auth', AdminMiddleware::class])->group(function(){
        Route::get('/', [DashboardController::class, 'index']);

        Route::get('/homepage', [BlogController::class, 'HomePage']);

        Route::get('/new/slide', [CarouselSildeController::class, 'admin']);
        Route::get('/api/slides', [CarouselSildeController::class, 'index_admin']);
        Route::post('/api/slides/new', [CarouselSildeController::class, 'store']);
        Route::post('/api/slides/update', [CarouselSildeController::class, 'update']);
        Route::post('/api/slides/delete', [CarouselSildeController::class, 'destroy']);


        Route::get('/blog/new', [BlogController::class, 'admin']);
        Route::get('/api/blog-posts', [BlogController::class, 'index_admin']);
        Route::post('/api/blog-posts', [BlogController::class, 'store']);
        Route::get('/api/blog-categories', [BlogController::class, 'categories']);
        Route::post('/api/blog-categories', [BlogController::class, 'new_category']);

        Route::get("/tour", [TourController::class, 'admin']);
        Route::get("/tour/new", [TourController::class, 'new']);
        Route::get('/api/tour-dates', [TourController::class, 'venues']);
        Route::post('/api/tour-dates', [TourController::class, 'store']);
        Route::delete('/api/tour-dates/{id}', [TourController::class, 'destroy']);

        Route::get("/products", [ProductsController::class, 'admin']);
        Route::get("/product/{id}", [ProductsController::class, 'edit']);
        Route::get("/products/new", [ProductsController::class, 'new']);
        Route::get("/api/products", [ProductsController::class, 'admin_products']);
        Route::get("/api/products/{id}", [ProductsController::class, 'admin_product']);
        Route::put("/api/products/{id}", [ProductsController::class, 'update']);
        Route::delete('/api/products/{id}', [ProductsController::class, 'delete']);
        Route::post("/api/products", [ProductsController::class, 'store']);
        Route::get("/api/categories", [ProductsController::class, 'categories']);
        Route::get("/api/taxes", [ProductsController::class, 'taxes']);
        Route::get("/api/providers", [ProductsController::class, 'providers']);
        Route::post("/api/categories", [ProductsController::class, 'store_category']);
        Route::post("/api/taxes", [ProductsController::class, 'store_tax']);
        Route::post("/api/providers", [ProductsController::class, 'store_provider']);
    });
    

    
});

Route::domain("ecommerce.com")->group(function (){
    Route::get('/', [HomeController::class, 'index'])->name('main');

    Route::get("/api/carousel", [CarouselSildeController::class, 'index']);

    Route::get("/blog/{blog}", [BlogController::class, "blog"]);
    Route::get("/api/blogs", [BlogController::class, "index"]);

    Route::get('/tour', [TourController::class, 'index'])->name('tour');
    Route::get('/api/tour', [TourController::class, 'venues']);

    Route::get('/products', [ProductsController::class, 'index'])->name('products');
    Route::Get("/api/products", [ProductsController::class, 'products']);

    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/api/contact', [ContactController::class, 'store']);

    
});

