<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function login(){
        if (Auth::check()) {
            // Redirigir a donde quieras, por ejemplo al dashboard
            return redirect("/");
        }
        return Inertia::render("admin/Login", [
            "title" => "login"
        ]);
    }

    public function logout(){
        if(Auth::check()){
            Auth::logout();
        }

        return redirect("/login");
    }

    public function signup(){
        if (Auth::check()) {
            // Redirigir a donde quieras, por ejemplo al dashboard
            return redirect("/");
        }
        return Inertia::render('admin/Signup', [
            "title" => "Register"
        ]);
    }

    public function validate(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->noContent();
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function register(Request $request){
         $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
    }
}
