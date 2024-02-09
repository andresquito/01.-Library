@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')


    {{-- Datos del cliente --}}
    <div class="container-fluid py-4">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form action="{{ route('factura.store') }}" method="POST">
                        @csrf
                        {{-- Datos del cliente --}}
                        <div class="card-body">
                            <h1><strong>Factura</strong> </h1>
                            <p><strong>Datos del cliente</strong> </p>
                            <div class="row">
                                <div class="col-md-4">
                                    {{-- Cédula --}}
                                    <x-adminlte-input type="text" name="cedula" label="Cédula"
                                        label-class="text-lightblue" value="{{ $cliente->cedula }}">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fas fa-id-card text-lightblue"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                </div>

                                <div class="col-md-4">
                                    {{-- Apellido --}}
                                    <x-adminlte-input type="text" name="apellido" label="Apellido"
                                        label-class="text-lightblue" value="{{ $cliente->apellido }}">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fas fa-user text-lightblue"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>

                                </div>
                                <div class="col-md-4">
                                    {{-- Nombre --}}
                                    <x-adminlte-input type="text" name="nombre" label="Nombre"
                                        label-class="text-lightblue" value="{{ $cliente->nombre }}">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text">
                                                <i class="fas fa-user text-lightblue"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>

                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- Detalles del producto -->
                            <div id="productos-container">
                                <!-- Campos para el primer producto -->
                                <div class="producto">
                                    <div class="row">
                                        {{-- <div class="col-md-5">
                                            <x-adminlte-input type="text" name="identificador"
                                                label-class="text-lightblue" placeholder="Identificador del producto">
                                                <!-- ... otras configuraciones del input ... -->
                                            </x-adminlte-input>
                                        </div> --}}
                                        <div class="col-md-5">
                                            <label for="productos">Identificador</label>
                                            <select class="form-control" name="identificador">
                                                @foreach ($obras as $obra)
                                                    <option value="{{ $obra->identificador }}">{{ $obra->identificador }}
                                                        {{ $obra->titulo }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="productos">Cantidad</label>
                                            <x-adminlte-input type="text" name="cantidad" label-class="text-lightblue"
                                                placeholder="Cantidad de productos">
                                                <!-- ... otras configuraciones del input ... -->
                                            </x-adminlte-input>
                                        </div>

                                        <div class="col-md-2">
                                            <!-- Botón para agregar más productos -->
                                            {{-- <button type="button" onclick="agregarProducto()">Agregar Producto</button> --}}

                                            <!-- Botón de venta -->
                                            <div class="col-md-12">
                                                <x-adminlte-button class="btn-flat" type="submit" label=""
                                                    theme="success" style="height: 40px;" icon="fas fa-lg fa-plus" />
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    {{-- Datos de los productos agregados para la venta --}}
                    <div class="card-body">
                        <p><strong>Datos de los productos agregados para la venta</strong> </p>
                        {{-- Setup data for datatables --}}
                        @php
                            $heads = ['Identificador', 'Descripción', 'Cantidad', 'Precio', 'Total', ['label' => 'Eliminar', 'no-export' => true, 'width' => 11]];

                            $btnEdit = '';
                            $btnDelete = '<button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                                <i class="fa fa-lg fa-fw fa-trash"></i>
                            </button>';
                            $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                                <i class="fa fa-lg fa-fw fa-eye"></i>
                            </button>';

                            $config = [
                                'language' => [
                                    'url' => '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                                ],
                            ];
                        @endphp


                        {{-- Minimal example / fill data using the component slot --}}
                        <x-adminlte-datatable id="table1" :heads="$heads" :config="$config">

                            @foreach ($facturas as $factura)
                                <tr>
                                    <td>{{ $factura->identificador }}</td>
                                    <td>{{ $factura->descripcion }}</td>
                                    <td>{{ $factura->cantidad }}</td>
                                    <td>{{ $factura->precio }}</td>
                                    <td>{{ $factura->total }}</td>
                                    <td>
                                            <form style='display: inline;' action="{{ route('factura.destroy', $factura) }}" method="POST"
                                                class="formEliminar">
                                                @csrf
                                                @method('delete')
                                                {!! $btnDelete !!}
                                            </form>

                                    </td>





                                </tr>
                            @endforeach

                        </x-adminlte-datatable>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <h3>Total de la venta:</h3>
                            </div>
                            <div class="col-md-2">
                                <h4>${{ number_format($ventaTotal, 2) }}</h4>
                            </div>


                        </div>
                        {{-- Botón para realizar la venta --}}
                        <div style="text-align: center;">
                            <form action="{{ route('factura.destroyAll') }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-success">Realizar Venta</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>









    <script>
        function agregarProducto() {
            // Clona el primer conjunto de campos y muestra el segundo conjunto
            var nuevoProducto = document.querySelector('#productos-container .producto:first-child').cloneNode(true);
            nuevoProducto.style.display = 'block';
            document.querySelector('#productos-container').appendChild(nuevoProducto);
        }
    </script>

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
