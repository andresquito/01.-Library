<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Venta;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $clientes = Client::all();
        return view('sistema.listCliente', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('sistema.addCliente');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validación para que los campos no pasen vacíos en la tabla
        $clients = $request->validate([
            'cedula' => 'required|unique:clients,cedula|max:10',
            'apellido' => 'required|max:100',
            'nombre' => 'required',
            'direccion' => 'required',
            'cantidad' => 'numeric',
            //para campo numerico
            //'edad'=>'numeric'
        ], ['required' => 'Este campo es requerido', 'max' => 'Solo se permite 10 caracteres'], ['numeric' => 'Este campo es requerido', 'max' => 'Solo se permite 2 caracteres']);
        $clients = new Client();

        $clients->cedula = $request->input('cedula');
        $clients->apellido = $request->input('apellido');
        $clients->nombre = $request->input('nombre');
        $clients->direccion = $request->input('direccion');
        $clients->cantidad = $request->input('cantidad');
        $clients->save();

        //retorna a la anterior ventana
        return back()->with('message', 'ok');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $cliente = Client::find($id);
        // $ventas = Venta::all();
        // return view('sistema.facturacion', compact('cliente','ventas'));
        return "hola";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $cliente = Client::find($id);
        return view('sistema.editCliente', compact('cliente'));
    }

    public function facturacion(string $id)
    {
        //
        $cliente = Client::find($id);
        return view('sistema.facturacion', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $clients = Client::find($id);
        //validación para que los campos no pasen vacíos en la tabla
        $request->validate([
            'cedula' => 'required|unique:clients,cedula|max:10',
            'apellido' => 'required|max:100',
            'nombre' => 'required',
            'direccion' => 'required',
            'cantidad' => 'numeric',
            //para campo numerico
            //'edad'=>'numeric'
        ], ['required' => 'Este campo es requerido', 'max' => 'Solo se permite 10 caracteres'], ['numeric' => 'Este campo es requerido', 'max' => 'Solo se permite 2 caracteres']);

        $clients->cedula = $request->input('cedula');
        $clients->apellido = $request->input('apellido');
        $clients->nombre = $request->input('nombre');
        $clients->direccion = $request->input('direccion');
        $clients->cantidad = $request->input('cantidad');
        $clients->save();

        //retorna a la anterior ventana
        return back()->with('message', 'Actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $cliente = Client::find($id);
        $cliente->delete();
        return back();
    }
}
