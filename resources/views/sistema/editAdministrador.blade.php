@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Administrador</h1>
@stop

@section('content')
    <p>Ingrese la información que desea cambiar</p>


    {{-- Registrar Nuevos Clientes --}}

    <div class="card">



        <div class="card-body">

            <form action="{{ route('administrador.update', $administrador )}}" method="POST">
                @csrf
                @method('PUT')
                {{-- nombre --}}
                <x-adminlte-input type="text" name="name" label="USUARIO" placeholder="Aquí nombre del administrador"
                    label-class="text-lightblue" value="{{ $administrador->name }}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-id-card text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                {{-- email--}}
                <x-adminlte-input type="email" name="email" label="EMAIL" placeholder="Aquí el email"
                    label-class="text-lightblue" value="{{ $administrador->email }}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user-edit text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                {{-- password --}}
                <x-adminlte-input type="text" name="password" label="PASSWORD" placeholder="Aquí password"
                    label-class="text-lightblue" value="{{ $administrador->password}}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user-edit text-lightblue"></i>
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

