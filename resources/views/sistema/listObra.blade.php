@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de Obras</h1>
@stop

@section('content')
    {{-- <p>Información de las obras</p> --}}

    {{-- Ver Clientes --}}

    <div class="card">
        <div class="card-body">
            {{-- Setup data for datatables --}}
            @php
            $heads = ['ID', 'Identificador', 'Tipo', 'Titulo', 'Autor', 'Género', 'Editorial', 'Frecuencia', 'Tipo Pintura', 'Creación', 'Recepción', 'Antiguedad', 'Stock', 'Precio', 'Total', ['label' => 'Opciones', 'no-export' => true, 'width' => 40]];

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

                @foreach ($obras as $obra)
                    <tr>
                        <td>{{ $obra->id }}</td>
                        <td>{{ $obra->identificador }}</td>
                        <td>{{ $obra->tipo }}</td>
                        <td>{{ $obra->titulo }}</td>
                        <td>{{ $obra->autor }}</td>
                        <td>{{ $obra->genero }}</td>
                        <td>{{ $obra->editorial}}</td>
                        <td>{{ $obra->frecuencia }}</td>
                        <td>{{ $obra->tipo_pintura }}</td>
                        <td>{{ $obra->año_creacion }}</td>
                        <td>{{ $obra->año_recepcion }}</td>
                        <td>{{ $obra->antiguedad }}</td>
                        <td>{{ $obra->stock }}</td>
                        <td>{{ $obra->precio }}</td>
                        <td>{{ $obra->total }}</td>
                        <td><a  href="{{route('obra.edit',$obra)}}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>
                            <form style='display: inline;' action="{{ route('obra.destroy', $obra)}}" method="POST"
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
