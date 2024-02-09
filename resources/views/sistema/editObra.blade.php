@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Obra</h1>
@stop

@section('content')
    <p>Ingrese la información que desea cambiar</p>


    <div class="container-fluid py-4">

        <div class="row">
            {{-- registro nuevo administrador --}}
            <div class="col-md-12">
                <div class="card">
                    {{-- Creación del formulario para poder enviar los datos en la db, el botón guardar debe de estar dentro del formulario y debe ser de type submit --}}
                    <form action="{{ route('obra.update', $obra) }}" method="post">
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

                                {{-- identificador --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Identificador</label>
                                        <input class="form-control" type="text" name="identificador" value="{{ $obra->identificador }}">
                                        {{-- codigo para que aparezca un mensaje de que se debe llenar el campo obligatoriamente --}}
                                        @error('identificador')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>

                                {{-- tipo --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Tipo</label>
                                        <select class="form-control" id="tipo" name="tipo"
                                            onchange="handleTipoChange(this)" >
                                            <option value="" disabled selected>{{ $obra->tipo }}</option>
                                            <option value="Libro">Libro</option>
                                            <option value="Revista">Revista</option>
                                            <option value="Pintura">Pintura</option>
                                        </select>
                                        {{-- codigo para que aparezca un mensaje de que se debe llenar el campo obligatoriamente --}}
                                        @error('tipo')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- titulo --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Título</label>
                                        <input class="form-control" type="text" name="titulo" value="{{ $obra->titulo }}">
                                        {{-- codigo para que aparezca un mensaje de que se debe llenar el campo obligatoriamente --}}
                                        @error('titulo')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- autor --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Autor</label>
                                        <input class="form-control" type="text" name="autor" value="{{ $obra->autor }}">
                                        {{-- codigo para que aparezca un mensaje de que se debe llenar el campo obligatoriamente --}}
                                        @error('autor')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- genero --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Género</label>
                                        <select class="form-control" id="genero" name="genero">
                                            <option value="" disabled selected>{{ $obra->genero }}</option>
                                            <option value="Infantil">Infantil</option>
                                            <option value="Ciencia ficción">Ciencia ficción</option>
                                            <option value="Historia Antigua">Historia Antigua</option>
                                        </select>
                                        {{-- codigo para que aparezca un mensaje de que se debe llenar el campo obligatoriamente --}}
                                        @error('genero')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- editorial --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Editorial</label>
                                        <input class="form-control" type="text" name="editorial" id="editorial" value="{{ $obra->editorial }}">
                                        {{-- codigo para que aparezca un mensaje de que se debe llenar el campo obligatoriamente --}}
                                        @error('editorial')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- frecuencia --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Frecuencia</label>
                                        <select class="form-control" id="frecuencia" name="frecuencia" value="{{ old('frecuencia') }}">
                                            <option value="" disabled selected>{{ $obra->frecuencia }}</option>
                                            <option value="Trimestral">Trimestral</option>
                                            <option value="Semestral">Semestral</option>
                                            <option value="Anual">Anual</option>
                                        </select>
                                        {{-- codigo para que aparezca un mensaje de que se debe llenar el campo obligatoriamente --}}
                                        @error('frecuencia')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- tipo pintura --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Tipo de Pintura</label>
                                        <select class="form-control" id="tipo_pintura" name="tipo_pintura" value="{{ old('tipo_pintura') }}">
                                            <option value="" disabled selected>{{ $obra->tipo_pintura }}</option>
                                            <option value="Paisajes">Paisajes</option>
                                            <option value="Humanas">Humanas</option>
                                            <option value="Bélicas">Bélicas</option>
                                        </select>
                                        {{-- codigo para que aparezca un mensaje de que se debe llenar el campo obligatoriamente --}}
                                        @error('tipo_pintura')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- año de creación --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Año de creación</label>
                                        <input class="form-control" type="date" id="año_creacion" name="año_creacion" value="{{ $obra->año_creacion }}">
                                        {{-- codigo para que aparezca un mensaje de que se debe llenar el campo obligatoriamente --}}
                                        @error('año_creacion')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- año de recepción --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Año de
                                            recepción</label>
                                        <input class="form-control" type="date" id="año_recepcion"
                                            name="año_recepcion" value="{{ $obra->año_recepcion }}">
                                        {{-- codigo para que aparezca un mensaje de que se debe llenar el campo obligatoriamente --}}
                                        @error('año_recepcion')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>



                                {{-- stock --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Stock</label>
                                        <input class="form-control" type="text" name="stock" value="{{ $obra->stock }}">
                                        {{-- codigo para que aparezca un mensaje de que se debe llenar el campo obligatoriamente --}}
                                        @error('stock')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- precio --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Precio</label>
                                        <input class="form-control" type="text" name="precio" value="{{ $obra->precio }}">
                                        {{-- codigo para que aparezca un mensaje de que se debe llenar el campo obligatoriamente --}}
                                        @error('precio')
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

        {{-- codigo para hacer que los inputs se desabiliten --}}

        <script>
            function handleTipoChange(selectElement) {
                var selectedTipo = selectElement.value;

                // Obtener referencias a los campos que deseas deshabilitar
                var frecuenciaInput = document.getElementById('frecuencia');
                var tipoPinturaInput = document.getElementById('tipo_pintura');
                var generoInput = document.getElementById('genero');
                var editorialInput = document.getElementById('editorial');

                // Deshabilitar o habilitar los campos según la selección de tipo
                if (selectedTipo === 'Libro') {
                    frecuenciaInput.disabled = true;
                    tipoPinturaInput.disabled = true;
                    generoInput.disabled = false;
                    editorialInput.disabled = false;
                } else if (selectedTipo === 'Revista') {
                    frecuenciaInput.disabled = false;
                    tipoPinturaInput.disabled = true;
                    generoInput.disabled = true;
                    editorialInput.disabled = true;
                } else if (selectedTipo === 'Pintura') {
                    frecuenciaInput.disabled = true;
                    tipoPinturaInput.disabled = false;
                    generoInput.disabled = true;
                    editorialInput.disabled = true;
                }
            }
        </script>
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

