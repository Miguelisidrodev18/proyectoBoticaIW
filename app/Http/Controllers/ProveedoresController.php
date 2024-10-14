<?php

namespace App\Http\Controllers;
use App\Models\Proveedores; // Importa el modelo

use Illuminate\Http\Request;

class ProveedoresController extends Controller
{
    public function index(){

        // Obtener todos los clientes de la base de datos
        $proveedores = Proveedores::all();

        // Pasar los clientes a la vista
        return view('proveedores.index', compact('proveedores'));
    }

    public function registrarProveedores(){
        return view('proveedores.registrarProveedores');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'ruc' => 'required|string|max:255',
            'nombre' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'estado' => 'required|in:Activo,Inactivo',
        ]);

        // Crear un nuevo proveedor en la base de datos
        Proveedores::create([
            'ruc' => $request->ruc,
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'estado' => $request->estado,
        ]);

        // Redirigir a una página con un mensaje de éxito
        return redirect()->route('proveedores.registrar')->with('success', 'Proveedor ingresado correctamente');
    }

}