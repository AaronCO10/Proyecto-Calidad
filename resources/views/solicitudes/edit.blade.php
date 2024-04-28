<!-- resources/views/solicitudes/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Editar Solicitud de Donación</h1>
    <hr>
    <div>
        <h2>Información de la Campaña</h2>
        <p><strong>ID de Campaña:</strong> {{ $solicitud->campania->id }}</p>
        <p><strong>Nombre:</strong> {{ $solicitud->campania->nombre }}</p>
        <p><strong>Fecha de Inicio:</strong> {{ $solicitud->campania->fecha_inicio }}</p>
        <p><strong>Fecha de Fin:</strong> {{ $solicitud->campania->fecha_fin ?? 'N/A' }}</p>
        <p><strong>Activo:</strong> {{ $solicitud->campania->activo ? 'Sí' : 'No' }}</p>
    </div>
    <hr>
    <div>
        <h2>Información del Solicitante</h2>
        <p><strong>ID de Solicitante:</strong> {{ $solicitud->user->id }}</p>
        <p><strong>Nombre:</strong> {{ $solicitud->user->name }}</p>
        <p><strong>Correo Electrónico:</strong> {{ $solicitud->user->email }}</p>
        <p><strong>Nombres:</strong> {{ $solicitud->user->nombres }}</p>
        <p><strong>Apellidos:</strong> {{ $solicitud->user->apellidos }}</p>
        <p><strong>DNI:</strong> {{ $solicitud->user->dni }}</p>
        <p><strong>Fecha de Nacimiento:</strong> {{ $solicitud->user->fecha_nacimiento }}</p>
        <p><strong>Sexo:</strong> {{ $solicitud->user->sexo }}</p>
        <p><strong>Tipo de Sangre:</strong> {{ $solicitud->user->tipo_sangre }}</p>
        <p><strong>Teléfono:</strong> {{ $solicitud->user->telefono }}</p>
    </div>
    <hr>
    <div>
        <h2>Información de la Solicitud</h2>
        <p><strong>ID de Solicitud:</strong> {{ $solicitud->id }}</p>
        <p><strong>Talla(cm) del solicitante:</strong> {{ $solicitud->talla }}</p>
        <p><strong>Peso(Kg) del solicitante:</strong> {{ $solicitud->peso }}</p>
        <p><strong>Estado:</strong> {{ $solicitud->estado }}</p>
        @if ($user->isAdmin())
            <form action="{{ route('solicitudes.update', $solicitud->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="estado">Nuevo Estado:</label>
                    <select name="estado" id="estado" class="form-control" required>
                        <option value="Pendiente" {{ $solicitud->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="Puede Donar" {{ $solicitud->estado == 'Puede Donar' ? 'selected' : '' }}>Puede Donar</option>
                        <option value="No Puede Donar" {{ $solicitud->estado == 'No Puede Donar' ? 'selected' : '' }}>No Puede Donar</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar Estado</button>
            </form>
        @endif
    </div>
    <hr>
@endsection
