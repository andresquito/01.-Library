<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $administradores = User::all();
        return view('sistema.listAdministrador', compact('administradores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('sistema.addAdministrador');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $users = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',

        ], ['required' => 'Este campo es requerido', 'max' => 'Solo se permite 10 caracteres'], ['numeric' => 'Este campo es requerido', 'max' => 'Solo se permite 2 caracteres']);
        $users = new User();

        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->password = $request->input('password');
        $users->save();

        //retorna a la anterior ventana
        return back()->with('message', 'ok');

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
        //
        $administrador = User::find($id);
        return view('sistema.editAdministrador', compact('administrador'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $administrador = User::find($id);
        //validación para que los campos no pasen vacíos en la tabla
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',

        ], ['required' => 'Este campo es requerido', 'max' => 'Solo se permite 10 caracteres'], ['numeric' => 'Este campo es requerido', 'max' => 'Solo se permite 2 caracteres']);

        $administrador->name = $request->input('name');
        $administrador->email = $request->input('email');
        $administrador->password = $request->input('password');
        $administrador->save();

        //retorna a la anterior ventana
        return back()->with('message', 'Actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $administrador = User::find($id);
        $administrador->delete();
        return back();
    }
}
