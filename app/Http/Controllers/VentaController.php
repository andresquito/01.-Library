<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use App\Models\Venta;
use App\Models\Client;
use App\Models\Factura;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::all();
        return view('sistema.listVenta', compact('ventas'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Client::all();
        $factura=Factura::all();
        return view('sistema.addVenta', compact('clientes','factura'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validación para que los campos no pasen vacíos en la tabla
        $ventas = $request->validate([
            'cedula' => 'required',
            'identificador' => 'required',
            'cantidad' => 'numeric',
            'fecha' => 'date',
            'precio' => 'numeric|between:0,9999999.99',
        ], ['required' => 'Este campo es requerido', 'max' => 'Solo se permite 100 caracteres'], ['numeric' => 'Este campo es requerido', 'max' => 'Solo se permite 5 caracteres'], ['between' => 'El valor debe estar entre :min y :max']);
        //$cliente = new Clientes();
        $ventas = new Venta();
        $ventas->cedula = $request->input('cedula');
        $ventas->identificador = $request->input('identificador');
        $ventas->cantidad = $request->input('cantidad');
        $ventas->fecha = now();


        // Buscar la venta por el identificador
        $obras = Obra::where('identificador', $ventas->identificador)->first();
        //$cliente = Clientes::where('cantidad', $venta->cantidad)->first();
        if ($obras) {
            // Si se encuentra la venta, obtener el precio de la obra relacionada
            $ventas->precio = $obras->precio;

            $ventas->total = $ventas->precio * $ventas->cantidad;
            $ventas->save();
            //return back()->with('message', 'ok');

        } else {

            return response()->json(['error' => 'Obra no encontrada'], 404);
        }

        //Condicional para agregar las cantidades de obras solicitadas del cliente a la tablas clientes y a la columna obras solicitadas cantidad.
        $clients = Client::where('cedula', $ventas->cedula)->first();

        if ($clients) {

            $clients->cantidad += $ventas->cantidad;
            $ventas->apellido= $clients->apellido;
            $ventas->nombre= $clients->nombre;
            $ventas->save();
            $clients->save();
            return back();
        } else {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $venta = Venta::find($id);
        return view('sistema.editVenta', compact('venta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ventas = Venta::find($id);
        $ventas->cedula=$request->input('cedula');
        $ventas->identificador = $request->input('identificador');
        $ventas->cantidad=$request->input('cantidad');
        $ventas->save();

        //retorna a la anterior ventana
        return back()->with('message', 'Actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $venta = Venta::find($id);
        $venta->delete();
        return back();
    }
}
