@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de Ventas</h1>
@stop

@section('content')
    {{-- <p>Información de las ventas</p> --}}

    {{-- Ver Clientes --}}

    <div class="card">
        <div class="card-body">
            {{-- Setup data for datatables --}}
            @php
            $heads = ['ID','Fecha', 'Cédula', 'Apellido','Nombre','Identificador', 'Descripcion','Cantidad', 'Precio', 'Total',  ['label' => 'Opciones', 'no-export' => true, 'width' => 40]];

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

                @foreach ($ventas as $venta)
                    <tr>
                        <td>{{ $venta->id }}</td>
                        <td>{{ $venta->fecha }}</td>
                        <td>{{ $venta->cedula }}</td>
                        <td>{{ $venta->apellido }}</td>
                        <td>{{ $venta->nombre}}</td>
                        <td>{{ $venta->identificador }}</td>
                        <td>{{ $venta->descripcion}}</td>
                        <td>{{ $venta->cantidad }}</td>
                        <td>{{ $venta->precio }}</td>
                        <td>{{ $venta->total }}</td>
                        <td><a  href="{{route('venta.edit',$venta)}}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>
                            <form style='display: inline;' action="{{ route('venta.destroy', $venta)}}" method="POST"
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
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.formEliminar').submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "Estas seguro?",
                    text: "Se va ha eliminar este registro!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();

                    }
                });
            })
        })
    </script>

@stop
