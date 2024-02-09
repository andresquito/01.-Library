@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Venta</h1>
@stop

@section('content')
    <p>Ingrese la información que desea cambiar</p>


    <div class="container-fluid py-4">

        <div class="row">
            {{-- registro nuevo administrador --}}
            <div class="col-md-12">
                <div class="card">
                    {{-- Creación del formulario para poder enviar los datos en la db, el botón guardar debe de estar dentro del formulario y debe ser de type submit --}}
                    <form action="{{ route('venta.update', $venta) }}" method="post">
                        @csrf
                        @method('PUT')
                        {{-- <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <h6>Registrar Nueva Obra</h6>
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Guardar</button>
                            </div>
                        </div> --}}
                        <div class="card-body">
                            {{-- <p class="text-uppercase text-sm">Información</p> --}}
                            <div class="row">


                                {{-- cedula --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label"># Cédula</label>
                                        <input class="form-control" type="text" name="cedula" value="{{ $venta->cedula }}">
                                        {{-- codigo para que aparezca un mensaje de que se debe llenar el campo obligatoriamente --}}
                                        @error('cedula')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                {{-- identificador --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Identificador</label>
                                        <input class="form-control" type="text" name="identificador" value="{{ $venta->identificador }}">
                                        {{-- codigo para que aparezca un mensaje de que se debe llenar el campo obligatoriamente --}}
                                        @error('identificador')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>


                                {{-- Cantidad --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Cantidad</label>
                                        <input class="form-control" type="text" name="cantidad" value="{{ $venta->cantidad }}">
                                        {{-- codigo para que aparezca un mensaje de que se debe llenar el campo obligatoriamente --}}
                                        @error('cantidad')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>

                            </div>
                            <x-adminlte-button class="btn-flat" type="submit" label="Actualizar" theme="success"
                            icon="fas fa-lg fa-save" />
                    </form>



                </div>
            </div>
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

