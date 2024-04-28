<!-- resources/views/solicitudes/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div>
        <h1>Detalles de Solicitud</h1>
        <h2>Campaña</h2>
        <p><strong>ID de Campaña:</strong> {{ $solicitud->campania->id }}</p>
        <p><strong>Nombre de la Campaña:</strong> {{ $solicitud->campania->nombre }}</p>
        <p><strong>Fecha de Inicio:</strong> {{ $solicitud->campania->fecha_inicio }}</p>
        <p><strong>Fecha de Fin:</strong> {{ $solicitud->campania->fecha_fin ?? 'N/A' }}</p>
        <p><strong>Estado de la Campaña:</strong> {{ $solicitud->campania->activo ? 'Activa' : 'Inactiva' }}</p>
    </div>

    <div>
        <h2>Datos del Solicitante</h2>
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

    <div>
        <h2>Datos de la Solicitud</h2>
        <p><strong>ID de Solicitud:</strong> {{ $solicitud->id }}</p>
        <p><strong>Fecha de Creación:</strong> {{ $solicitud->created_at }}</p>
        <p><strong>Talla:</strong> {{ $solicitud->talla }}</p>
        <p><strong>Peso:</strong> {{ $solicitud->peso }}</p>
        <p><strong>Estado:</strong>
            @if ($solicitud->estado === 'Pendiente')
                <span class="badge badge-warning">{{ $solicitud->estado }}</span>
            @elseif ($solicitud->estado === 'Puede Donar')
                <span class="badge badge-success">{{ $solicitud->estado }}</span>
            @elseif ($solicitud->estado === 'No Puede Donar')
                <span class="badge badge-danger">{{ $solicitud->estado }}</span>
            @endif
        </p>
    </div>
@endsection
