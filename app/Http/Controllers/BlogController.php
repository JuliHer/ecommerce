<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function admin(){
        return Inertia::render("admin/Blog", [
            "title" => "admin"
        ]);
    }

    public function HomePage(){
        return Inertia::render("admin/Homepage", [
            "title" => "admin"
        ]);
    }
    
    public function index(){
        return BlogPost::where('published', true)->get();
    }

    public function index_admin(){
        return BlogPost::all();
    }

    
    public function blog($blog){

        $blogPost = BlogPost::where("slug", $blog);
        return Inertia::render("Blog/Show", [
            "blog" => $blogPost
        ]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'category_id' => 'required|exists:blog_categories,id',
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|image|max:5120', // hasta 5MB
            'published' => 'boolean',
        ]);

        // 2) Generar slug a partir del título
        $validated['slug'] = Str::slug($validated['title']);

        // 3) Subir imagen si viene incluida
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('blog', 'public');
            $validated['image'] = Storage::url($path); // Guarda la URL accesible públicamente
        }

        // 4) Si el post está publicado, setear published_at
        if (!empty($validated['published'])) {
            $validated['published_at'] = now();
        }

        // 5) Crear el post
        $post = BlogPost::create($validated);

        return response()->json($post, 201);
    }

    public function categories(){
        return BlogCategory::all();
    }

    public function new_category(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $category = BlogCategory::create($validated);
        return response()->json($category, 201);
    }
}
