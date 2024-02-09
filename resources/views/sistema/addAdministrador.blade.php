@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Registrar Nuevo Administrador</h1>
@stop

@section('content')
    <p>Ingresa información del nuevo administrador</p>

    @php
        if (session()) {
            if (session('message') == 'ok') {
                echo '<x-adminlte-alert class="bg-teal text-uppercase" icon="fa fa-lg fa-thumbs-up" title="Done" dismissable>
        Administrador Registrado!
        </x-adminlte-alert>';
            }
        }
    @endphp

    {{-- Registrar Nuevos Clientes --}}

    <div class="card">



        <div class="card-body">

            <form action="{{ route('administrador.store') }}" method="POST">
                @csrf
                {{-- nombre --}}
                <x-adminlte-input type="text" name="name" label="USUARIO" placeholder="Aquí nombre del administrador"
                    label-class="text-lightblue" value="{{ old('name') }}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                {{-- email--}}
                <x-adminlte-input type="email" name="email" label="EMAIL" placeholder="Aquí el email"
                    label-class="text-lightblue" value="{{ old('email') }}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-mail-bulk text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                {{-- password --}}
                <x-adminlte-input type="text" name="password" label="PASSWORD" placeholder="Aquí password"
                    label-class="text-lightblue" value="{{ old('password') }}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-key text-lightblue"></i>
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
