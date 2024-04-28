<!-- resources/views/solicitudes/index.blade.php -->
@extends('layouts.app')

@section('content')
    @guest
    <!-- Si el usuario no ha iniciado sesión, redirigir a la página principal -->
    <script>window.location = "{{ route('home') }}";</script>
    @else
    <!-- Mostrar botón de crear solicitud si el usuario puede crear una nueva solicitud -->
        <h1>Listado de Solicitudes de Donación</h1>
        @if ($puedesolicitar)
        <a href="{{ route('solicitudes.create') }}" class="btn btn-primary">Crear Solicitud</a>
    @endif
        <table class="table">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Campaña</th>
                    <th>Talla</th>
                    <th>Peso</th>
                    <th>Acepta Términos</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($solicitudes as $solicitud)
                    <tr>
                        <td>{{ $solicitud->user->name }}</td>
                        <td>{{ $solicitud->campania->nombre }}</td>
                        <td>{{ $solicitud->talla }}</td>
                        <td>{{ $solicitud->peso }}</td>
                        <td>{{ $solicitud->acepta_terminos ? 'Sí' : 'No' }}</td>
                        <td>{{ $solicitud->estado }}</td>
                        <td>
                            <a href="{{ route('solicitudes.show', $solicitud->id) }}" class="btn btn-info">Detalles</a>
                            @can('admin', $solicitud)
                                <a href="{{ route('solicitudes.edit', $solicitud->id) }}" class="btn btn-primary">Editar Estado</a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endguest
@endsection
