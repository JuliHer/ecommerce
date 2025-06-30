<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index(){
        return BlogPost::all();
    }

    public function blog($blog){

        $blogPost = BlogPost::where("slug", $blog);
        return Inertia::render("Blog.Show", [
            "blog" => $blogPost
        ]);
    }
}
