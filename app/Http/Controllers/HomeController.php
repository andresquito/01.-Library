<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $obras = Obra::all();
        $ventas = Venta::all();


        $ventaTotal = Obra::sum('total');
        $ventaLibros = Venta::where('identificador', 'like', 'L%')->sum('total');
        $ventaRevistas = Venta::where('identificador', 'like', 'R%')->sum('total');
        $ventaPinturas = Venta::where('identificador', 'like', 'P%')->sum('total');
        //esta busqueda tomo los mismos valores que tiene en identificador y suma los valores de la tabla total
        $ventaxobra=0;
        //$ventaxobra = \App\Models\Venta::groupBy('identificador')->sum('total');




        $venta = new Venta();
        $numeroObras = $request->input('numero');
        $clientesUnicos = Venta::where('cantidad', $numeroObras)->distinct('cedula')->count();

        $venta->tipo = $request->input('tipo');
        switch ($venta->tipo) {
            case 'Libro':
                $numeroClientes = Venta::where('cantidad', $numeroObras)->where('identificador', 'like', 'L%')->distinct('cedula')->count();
                break;

            case 'Revista':
                $numeroClientes = Venta::where('cantidad', $numeroObras)->where('identificador', 'like', 'R%')->distinct('cedula')->count();
                break;

            case 'Pintura':
                $numeroClientes = Venta::where('cantidad', $numeroObras)->where('identificador', 'like', 'P%')->distinct('cedula')->count();
                break;

            default:
                // Manejar el caso en el que el tipo no coincide con Libro, Revista o Pintura
                $numeroClientes = 0;
                break;
        }
        return view('home', compact('ventaTotal', 'ventaLibros', 'ventaRevistas', 'ventaPinturas', 'numeroClientes', 'obras', 'ventas', 'ventaxobra'));
    }
}
