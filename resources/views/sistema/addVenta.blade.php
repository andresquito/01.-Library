@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Nueva Venta</h1>
@stop

@section('content')
    {{-- <p>Welcome to this beautiful admin panel.</p> --}}

    {{-- Ver Clientes --}}

    <div class="card">
        <div class="card-body">
            {{-- Setup data for datatables --}}
            @php
                $heads = ['Cedula', 'Apellido', 'Nombre', 'Dirección', ['label' => 'Vender', 'no-export' => true, 'width' => 15]];

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

                @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->cedula }}</td>
                        <td>{{ $cliente->apellido }}</td>
                        <td>{{ $cliente->nombre }}</td>
                        <td>{{ $cliente->direccion }}</td>
                        <td><a href="{{ route('factura.show', $cliente) }}" class="btn btn-xs btn-default text-success mx-1 shadow" title="Vender">
                            <i class="fas fa-lg fa-fw fa-dollar-sign"></i>
                        </a>
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
        console.log('Hi!');
    </script>
@stop
