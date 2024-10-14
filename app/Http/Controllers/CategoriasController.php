<?php

namespace App\Http\Controllers;
use App\Models\Categorias; 
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index(){

        // Obtener todos los clientes de la base de datos
        $categorias = Categorias::all();

        // Pasar los clientes a la vista
        return view('categorias.index', compact('categorias'));
    }

    public function registrarCategorias(){
        return view('categorias.registrarCategorias');
    }
    
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'estado' => 'required|in:Activo,Inactivo',
        ]);
        
        // Crear un nuevo cliente en la base de datos
        Categorias::create([
            'nombre' => $request->nombre,
            'estado' => $request->estado,
        ]);

        // Redirigir a una página con un mensaje de éxito
        return redirect()->route('categorias.registrar')->with('success', 'Categoria ingresado correctamente');
    }
}