@extends('adminlte::page')

@section('title', 'Panel de Control')

@section('content_header')
    <h1>Panel de Control</h1>
@stop

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    {{-- Hora --}}
    {{-- <h3 id="datetime">Loading...</h3>
<script>
    function updateDateTime() {
        var now = new Date();
        var formattedDateTime = now.getFullYear() + '-' + (now.getMonth() + 1).toString().padStart(2, '0') + '-' + now.getDate().toString().padStart(2, '0') + ' ' + now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2, '0') + ':' + now.getSeconds().toString().padStart(2, '0');

        document.getElementById('datetime').innerHTML = 'Fecha: ' + formattedDateTime;
    }

    setInterval(updateDateTime, 1000); // Actualiza cada segundo (1000 milisegundos)
    updateDateTime(); // Llamada inicial para mostrar la fecha y hora inmediatamente
</script> --}}

    {{-- ingresos totales --}}

    <div class="container-fluid py-4">
        <div class="row">
            {{-- Ingresos al vender todas las obras --}}
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">

                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Ingresos totales</p>
                                    <h5 class="font-weight-bolder">
                                        {{-- codigo para indicar el valor de la suma total de la columna precio de la tabla obras desde la funcion stor del PanelController --}}
                                        ${{ number_format($ventaTotal, 2) }}

                                    </h5>
                                    <p class="mb-0">
                                        Al vender todas las obras
                                    </p>
                                </div>
                            </div>

                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="fas fa-coins text-white text-sm opacity-10"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Ingresos de libros vendidos --}}
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">INGRESOS TOTALES</p>
                                    <h5 class="font-weight-bolder">
                                        ${{ number_format($ventaLibros, 2) }}
                                    </h5>
                                    <p class="mb-0">
                                        De LIBROS vendidos hasta le fecha
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="fas fa-book-open text-white text-sm opacity-10"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Ingresos de revistas vendidas --}}
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">INGRESOS TOTALES</p>
                                    <h5 class="font-weight-bolder">
                                        ${{ number_format($ventaRevistas, 2) }}
                                    </h5>
                                    <p class="mb-0">
                                        De REVISTAS vendidas
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="far fa-file-alt text-white text-sm opacity-10"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Ingresos de pinturas vendidas --}}
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">INGRESOS TOTALES</p>
                                    <h5 class="font-weight-bolder">
                                        ${{ number_format($ventaPinturas, 2) }}
                                    </h5>
                                    <p class="mb-0">
                                        De PINTURAS vendidas
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <i class="fas fa-palette text-white text-sm opacity-10"></i>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- segunda fila del panel de control --}}

        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-body p-3">
                        <div class="chart">
                            {{-- Número de usuarios por obras vendidas --}}
                            <div class="row mb-4">
                                <div class="col-8">
                                    <form action="{{ asset('home') }}">
                                        @csrf
                                        <div class="card-header pb-0">
                                            <div class="d-flex align-items-center">
                                                <h6>Clientes que hayan comprado</h6>
                                            </div>
                                            <div class="row">
                                                {{-- Número de obras --}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label"># de
                                                            Obras</label>
                                                        <select class="form-control" name="numero">
                                                            <option value="">Seleccione</option>
                                                            @for ($i = 1; $i <= 10; $i++)
                                                                <option value="{{ $i }}">{{ $i }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                        {{-- Código para mostrar un mensaje de que el campo es obligatorio --}}
                                                        @error('identificador')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <x-adminlte-button class="btn-flat" type="submit" label="Enviar"
                                                        theme="success" icon="fas fa-lg fa-save" />
                                                </div>
                                                {{-- Tipo --}}
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="example-text-input"
                                                            class="form-control-label">Tipo</label>
                                                        <select class="form-control" id="tipo" name="tipo"
                                                            onchange="handleTipoChange(this)">
                                                            <option value="" disabled selected>Seleccione</option>
                                                            <option value="Libro">Libro</option>
                                                            <option value="Revista">Revista</option>
                                                            <option value="Pintura">Pintura</option>
                                                        </select>
                                                        {{-- Código para mostrar un mensaje de que el campo es obligatorio --}}
                                                        @error('tipo')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-4">
                                    <div class="card">
                                        <div class="card-body p-3">
                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="numbers">
                                                        <h1 class="font-weight-bolder"
                                                            style="font-size: 80px; color: blue;">
                                                            {{ number_format($numeroClientes) }}
                                                        </h1>
                                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">CLIENTES</p>
                                                    </div>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <div
                                                        class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                                        <i class="fas fa-users text-white text-sm opacity-10"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Carrusel --}}
            <div class="col-lg-5">
                <div class="card card-carousel overflow-hidden h-100 p-0">
                    <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
                        <div class="carousel-inner border-radius-lg h-100">
                            <div class="carousel-item h-100 active"
                                style="background-image: url('{{ asset('assets/img/uno.jpg') }}'); background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                        <i class="ni ni-camera-compact text-dark opacity-10"></i>
                                    </div>
                                    <h6 class="text-white mb-1">BIBLIOTECA</h6>
                                </div>
                            </div>
                            <div class="carousel-item h-100"
                                style="background-image: url('{{ asset('assets/img/libroscarrusel.jpg') }}'); background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                        <i class="ni ni-bulb-61 text-dark opacity-10"></i>
                                    </div>
                                    <h6 class="text-white mb-1">LIBROS</h6>
                                </div>
                            </div>
                            <div class="carousel-item h-100"
                                style="background-image: url('{{ asset('assets/img/revistascarrusel.jpg') }}'); background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                        <i class="ni ni-bulb-61 text-dark opacity-10"></i>
                                    </div>
                                    <h6 class="text-white mb-1">REVISTAS</h6>
                                </div>
                            </div>
                            <div class="carousel-item h-100"
                                style="background-image: url('{{ asset('assets/img/pinturascarrusel.jpg') }}'); background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                        <i class="ni ni-trophy text-dark opacity-10"></i>
                                    </div>
                                    <h6 class="text-white mb-1">PINTURAS</h6>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev w-5 me-3" type="button"
                            data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next w-5 me-3" type="button"
                            data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- Lista de ventas totales  --}}

    <div class="card">
        <div class="card-body">
            <h4>Lista de ventas por obra</h4>
            {{-- Setup data for datatables --}}
            @php
                $heads = ['Identificador', 'Tipo', 'Título', 'Año de Publicación', 'Antiguedad', 'Ventas'];

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
                {{-- consulta que muestra las ventas totales por obras --}}
                    <?php
                    $ventaxobra = \App\Models\Venta::where('identificador', $obra->identificador)->sum('total');
                    ?>
                    <tr>
                        <td>{{ $obra->identificador }}</td>
                        <td>{{ $obra->tipo }}</td>
                        <td>{{ $obra->titulo }}</td>
                        <td>{{ $obra->año_creacion }}</td>
                        <td>{{ $obra->antiguedad }}</td>
                        <td>{{ $ventaxobra }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
