@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Cliente</h1>
@stop

@section('content')
    <p>Ingrese la información que desea cambiar</p>


    {{-- Registrar Nuevos Clientes --}}

    <div class="card">



        <div class="card-body">

            <form action="{{ route('cliente.update', $cliente) }}" method="POST">
                @csrf
                @method('PUT')
                {{-- Cédula --}}
                <x-adminlte-input type="text" name="cedula" label="CEDULA" label-class="text-lightblue"
                    value="{{ $cliente->cedula }}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-id-card text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                {{-- Apellido --}}
                <x-adminlte-input type="text" name="apellido" label="APELLIDOS" label-class="text-lightblue"
                    value="{{ $cliente->apellido }}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user-edit text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                {{-- Nombre --}}
                <x-adminlte-input type="text" name="nombre" label="NOMBRES" label-class="text-lightblue"
                    value="{{ $cliente->nombre }}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user-edit text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                {{-- Dirección --}}
                <x-adminlte-input type="text" name="direccion" label="DIRECCION" label-class="text-lightblue"
                    value="{{ $cliente->direccion }}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-map-marker text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                {{-- Cantidad --}}
                {{-- <x-adminlte-input type="text" name="cantidad" label="CANTIDAD DE OBRAS SOLICITADAS"
                    placeholder="Aquí cantidad de obras solicitadas" label-class="text-lightblue">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-sort-numeric-up text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input> --}}

                <x-adminlte-button class="btn-flat" type="submit" label="Actualizar" theme="success"
                    icon="fas fa-lg fa-save" />
            </form>


        </div>


    </div>




@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    @if (session('message'))
        <script>
            $(document).ready(function() {
                let mensaje = "{{ session('message') }}";
                Swal.fire({
                    title: 'Resultado',
                    text: mensaje,
                    icon: 'success'
                });
            });
        </script>
    @endif
@stop

