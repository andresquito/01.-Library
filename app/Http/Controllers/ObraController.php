<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use Illuminate\Http\Request;

class ObraController extends Controller
{
    public function index()
    {
        //
        $obras = Obra::all();
        return view('sistema.listObra', compact('obras'));
    }

    public function create()
    {
        return view('sistema.addObra');
    }



    public function store(Request $request)
    {
        //validación para que los campos no pasen vacíos en la tabla

        $obras = $request->validate([
            //'identificador' => 'required',
            'tipo' => 'required|max:100',
            'titulo' => 'required',
            'autor' => 'required',
            //   'genero'=>'required',
            //   'editorial'=>'required',
            //   'frecuencia'=>'required',
            //   'tipo_pintura'=>'required',
            'año_creacion' => 'date',
            'año_recepcion' => 'date',
            //   'antiguedad'=>'required',
            'stock' => 'numeric',
            'precio' => 'numeric|between:0,9999999.99',

            //   para campo numerico
            //   'edad'=>'numeric'
        ], ['required' => 'Este campo es requerido', 'max' => 'Solo se permite 100 caracteres'], ['numeric' => 'Este campo es requerido', 'max' => 'Solo se permite 5 caracteres'], ['between' => 'El valor debe estar entre :min y :max']);
        //Lógica para pasar los valores de los inputs a la base de datos
        $obras = new Obra();
        $obras->tipo = $request->input('tipo');
        $obras->titulo = $request->input('titulo');
        $obras->autor = $request->input('autor');
        $obras->genero = $request->input('genero');
        $obras->editorial = $request->input('editorial');
        $obras->frecuencia = $request->input('frecuencia');
        $obras->tipo_pintura = $request->input('tipo_pintura');
        $obras->año_creacion = $request->input('año_creacion');
        $obras->año_recepcion = $request->input('año_recepcion');
        $obras->antiguedad = $request->input('antiguedad');
        $obras->stock = $request->input('stock');
        $obras->precio = $request->input('precio');
        $obras->total = $obras->precio * $obras->stock;
        // Lógica para determinar la antigüedad
        $año_creacion = intval(date('Y', strtotime($request->input('año_creacion'))));
        $año_actual = intval(date('Y'));
        $edad_obra = $año_actual - $año_creacion;
        if ($obras->tipo === 'Pintura') {
            if ($edad_obra >= 10 && $edad_obra <= 20) {
                $obras->antiguedad = 'Contemporanea';
            } elseif ($edad_obra > 20 && $edad_obra <= 100) {
                $obras->antiguedad = 'Vieja';
            } elseif ($edad_obra > 100) {
                $obras->antiguedad = 'Vetusta';
            } else {
                $obras->antiguedad = 'Nueva';
            }
        } else {
        }
        //Lógica para el identificador automático
        $obras->identificador = substr($obras->tipo, 0, 1);
        //Esta líne de código me trae el número mayor de la columna id de la tabla Obra
        $id = Obra::max('id');
        // Verificar si el tipo comienza con 'L'
        if (strtoupper($obras->identificador) === 'L') {
            // Sumar la primera letra del 'genero'
            $obras->identificador .= substr($request->input('genero'), 0, 1);

            // Sumar la primera letra del 'editorial'
            $obras->identificador .= substr($request->input('editorial'), 0, 1);

            // Obtener el ID que se le va a asignar
            $nuevoId = $id+1; // Reemplaza esto con tu lógica para obtener el próximo ID

            // Sumar el nuevo ID (asegúrate de que $nuevoId sea una cadena antes de concatenarlo)
            $obras->identificador .= strval($nuevoId);
        }
        if (strtoupper($obras->identificador) === 'R') {
            // Sumar la primera letra del 'genero'
            $obras->identificador .= substr($request->input('autor'), 0, 1);

            // Sumar la primera letra del 'editorial'
            $obras->identificador .= substr($request->input('frecuencia'), 0, 1);

            // Obtener el ID que se le va a asignar
            $nuevoId = $id+1; // Reemplaza esto con tu lógica para obtener el próximo ID

            // Sumar el nuevo ID (asegúrate de que $nuevoId sea una cadena antes de concatenarlo)
            $obras->identificador .= strval($nuevoId);
        }
        if (strtoupper($obras->identificador) === 'P') {
            // Sumar la primera letra del 'genero'
            $obras->identificador .= substr($request->input('tipo_pintura'), 0, 1);

            // Sumar la primera letra del 'editorial'
            $obras->identificador .= substr($request->input('antiguedad'), 0, 1);

            // Obtener el ID que se le va a asignar
            $nuevoId = $id+1; // Reemplaza esto con tu lógica para obtener el próximo ID

            // Sumar el nuevo ID (asegúrate de que $nuevoId sea una cadena antes de concatenarlo)
            $obras->identificador .= strval($nuevoId);
        }





        $obras->save();
        //retorna a la anterior ventana
        return back()->with('message', 'ok');
    }

    public function destroy(string $id)
    {
        //
        $obra = Obra::find($id);
        $obra->delete();
        return back();
    }

    public function edit($id)
    {
        $obra = Obra::find($id);
        return view('sistema.editObra', compact('obra'));
    }

    public function update(Request $request, $id)
    {
        $obra = Obra::find($id);
        $obra->identificador = $request->input('identificador');
        $obra->tipo = $request->input('tipo');
        $obra->titulo = $request->input('titulo');
        $obra->autor = $request->input('autor');
        $obra->genero = $request->input('genero');
        $obra->editorial = $request->input('editorial');
        $obra->frecuencia = $request->input('frecuencia');
        $obra->tipo_pintura = $request->input('tipo_pintura');
        $obra->año_creacion = $request->input('año_creacion');
        $obra->año_recepcion = $request->input('año_recepcion');
        $obra->antiguedad = $request->input('antiguedad');
        $obra->stock = $request->input('stock');
        $obra->precio = $request->input('precio');
        $obra->save();

        //retorna a la anterior ventana
        return back()->with('message', 'Actualizado correctamente');
    }
}
