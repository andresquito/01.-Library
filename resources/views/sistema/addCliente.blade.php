@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Registrar Nuevo Cliente</h1>
@stop

@section('content')
    <p>Ingrese la información del nuevo cliente</p>
    @php
        if (session()) {
            if (session('message') == 'ok') {
                echo '<x-adminlte-alert class="bg-teal text-uppercase" icon="fa fa-lg fa-thumbs-up" title="Done" dismissable>
            Cliente Registrado!
            </x-adminlte-alert>';
            }
        }
    @endphp



    {{-- Registrar Nuevos Clientes --}}

    <div class="card">



        <div class="card-body">

            <form action="{{ route('cliente.store') }}" method="POST">
                @csrf
                {{-- Cédula --}}
                <x-adminlte-input type="text" name="cedula" label="CEDULA" placeholder="Aquí número de cédula"
                    label-class="text-lightblue" value="{{ old('cedula') }}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-id-card text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                {{-- Apellido --}}
                <x-adminlte-input type="text" name="apellido" label="APELLIDOS" placeholder="Aquí apellidos"
                    label-class="text-lightblue" value="{{ old('apellido') }}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user-edit text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                {{-- Nombre --}}
                <x-adminlte-input type="text" name="nombre" label="NOMBRES" placeholder="Aquí nombres"
                    label-class="text-lightblue" value="{{ old('nombre') }}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user-edit text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                {{-- Dirección --}}
                <x-adminlte-input type="text" name="direccion" label="DIRECCION" placeholder="Aquí dirección"
                    label-class="text-lightblue" value="{{ old('direccion') }}">
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

                <x-adminlte-button class="btn-flat" type="submit" label="Guardar" theme="success"
                    icon="fas fa-lg fa-save" />
            </form>


        </div>


    </div>




@stop



@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
