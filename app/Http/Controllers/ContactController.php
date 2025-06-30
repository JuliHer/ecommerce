<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function index(){
        return Inertia::render('Contact', [
            "title" => "Contactanos"
        ]);
    }

    public function store(Request $request){
        // Validar el request
        $validated = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ])->validate();

        // Guardar en la base de datos
        $contactMessage = ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
            'status' => ContactMessage::STATUS_NEW,
        ]);

        // Retornar respuesta (idealmente JSON si lo consumes desde Vue)
        return response()->json([
            'message' => 'Mensaje recibido, nos pondremos en contacto pronto.',
            'contact' => $contactMessage,
        ], 201);
    }
}
