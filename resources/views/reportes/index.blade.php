@extends('layouts.admin')
@section('titulo', 'Lista de reporte de pasajeros')
@section('contenido')
    <link rel="stylesheet" href="{{ asset('css/tablas.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <div class="row">
        <div class="col-6 float-left">
            <h2>Lista de reportes:</h2>
        </div>
        <div class="col-6">
            <a href="{{ route('reportes.create') }}" class="btn btn-primary btn-sm float-right mr-2">Nuevo Reporte</a>
        </div>
        <div class="col-12">
            @if (session('status'))
                <div class="text-success">
                    <div class="alert alert-danger" role="alert">
                        {{ session('status') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <table id="tabladatos" class="table mt-4 table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Cod</th>
                        <th scope="col">Paquete:</th>
                        <th scope="col">Nombre pax:</th>
                        <th scope="col" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reportes as $reporte)
                        @php
                            $nombre = $reporte->nombre;
                            $fecha = $reporte->created_at->format('Y-m-d'); // Utiliza la fecha de creación del reporte
                            
                            $iniciales = '';
                            $palabras = explode(' ', $nombre);
                            
                            foreach ($palabras as $palabra) {
                                $iniciales .= strtoupper(substr($palabra, 0, 1));
                            }
                            
                            $variableConcatenada = $iniciales . date('Ymd', strtotime($fecha)) . 'MIT';
                        @endphp
                        <tr class="tablainfo">
                            <td>{{ $reporte->id }}</td>
                            <td>{{ $variableConcatenada }}</td>
                            <td>{{ $reporte->tour }}</td>
                            <td>{{ $reporte->nombre }}</td>
                            <td class="text-center accionestable" style="width: 130px">
                                <a href="{{ route('reportes.edit', $reporte->id) }}" target="_blank"
                                    class="btn btn-primary btn-sm" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('reporte', ['id' => $reporte->id, 'fecha' => $reporte->fechaInicio, 'nombre' => urlencode($reporte->nombre)]) }}"
                                    class="btn btn-sm btn-info" title="Ver Reporte" target="_blank">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <form action="{{ route('reportes.destroy', $reporte->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Borrar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        var j = jQuery.noConflict();
        j(document).ready(function() {
            j('#tabladatos').DataTable();
        });
    </script>

@endsection
