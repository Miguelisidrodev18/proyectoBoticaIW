<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){

        // Obtener todos los clientes de la base de datos
        $users = User::all();
        
        // Pasar los clientes a la vista
        return view('users.index', compact('users'));
    }

    public function registrarUsers(){
        return view('users.registrarUsers');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required',
        ]);

        // Crear el usuario
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encriptar la contraseña
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('users.registrar')->with('success', 'Usuario creado correctamente');
    }
}