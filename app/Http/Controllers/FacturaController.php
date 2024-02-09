<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obra;
use App\Models\Client;
use App\Models\Factura;
use App\Models\Venta;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {



        $facturas = new Factura();
        $ventas= new Venta();
        $facturas->identificador = $request->input('identificador');
        $facturas->cantidad = $request->input('cantidad');

        // Buscar la venta por el identificador
        $obras = Obra::where('identificador', $facturas->identificador)->first();
        //$cliente = Clientes::where('cantidad', $venta->cantidad)->first();
        if ($obras) {
            if($obras->stock >= $facturas->cantidad){
            $facturas->cedula=$request->input('cedula');
            $facturas->apellido=$request->input('apellido');
            $facturas->nombre=$request->input('nombre');
            $facturas->precio = $obras->precio;
            $facturas->descripcion = $obras->titulo;
            $facturas->total = $facturas->precio * $facturas->cantidad;
            $facturas->save();
            //codigo que va disminuyendo el estok segun las ventas
            $obras->stock=$obras->stock-$facturas->cantidad;
            $obras->save();

            }else{
                return response()->json(['error' => 'La cantidad solicitada supera el stock disponible'], 400);
            }
        } else {

            return response()->json(['error' => 'Obra no encontradaa'], 404);
        }

        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = Client::find($id);
        $facturas = Factura::all();
        $venta=Venta::all();
        $obras=Obra::all();
        $ventaTotal=Factura::sum('total');
        return view('sistema.facturacion', compact('cliente','facturas','ventaTotal','venta','obras'));


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $factura = Factura::find($id);
        $factura->delete();


        return back();
    }

    public function destroyAll()
    {
        //paso todos los datos de factura y los guardo en la variable
        $datosFactura = Factura::all();
        //logica para crear las variables que no posee la tabla facturas y si posee la tabla ventas
        $datosVenta = $datosFactura->map(function ($item) {
            unset($item['created_at']);
            unset($item['updated_at']);
            return $item;
        })->toArray();
        $ultimoIdVenta = Venta::max('id');
        $nuevoId = $ultimoIdVenta + 1;

        foreach ($datosVenta as &$fila) {
            $fila['fecha'] = now();
            $fila['id'] = $nuevoId;
            $nuevoId++;
        }
        //inserto los productos de la factura a ventas realizadas
        Venta::insert($datosVenta);
        //borro todos los datos de la tabla factura
        Factura::truncate();
        return back();
    }


}
