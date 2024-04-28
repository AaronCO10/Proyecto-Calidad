<!-- resources/views/solicitudes/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div>
        <h1>Registrar Solicitud de Donación</h1>

        <form action="{{ route('solicitudes.store') }}" method="POST">
            @csrf

            <!-- Campos del formulario para crear usuario (si no ha iniciado sesión) -->
            @if (!Auth::check())
                <div class="form-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nombres">Nombres:</label>
                    <input type="text" name="nombres" id="nombres" class="form-control" required>
                    @error('nombres')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Agrega el resto de campos con sus respectivas validaciones y mensajes de error -->
                <div class="form-group">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" name="apellidos" id="apellidos" class="form-control" required>
                    @error('apellidos')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Agrega el resto de campos con sus respectivas validaciones y mensajes de error -->
                <div class="form-group">
                    <label for="dni">DNI:</label>
                    <input type="text" name="dni" id="dni" class="form-control" required>
                    @error('dni')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Agrega el resto de campos con sus respectivas validaciones y mensajes de error -->
                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" required>
                    @error('fecha_nacimiento')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Agrega el resto de campos con sus respectivas validaciones y mensajes de error -->
                <div class="form-group">
                    <label for="sexo">Sexo:</label>
                    <select name="sexo" id="sexo" class="form-control" required>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                    </select>
                    @error('sexo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Agrega el resto de campos con sus respectivas validaciones y mensajes de error -->
                <div class="form-group">
                    <label for="tipo_sangre">Tipo de Sangre:</label>
                    <input type="text" name="tipo_sangre" id="tipo_sangre" class="form-control" required>
                    @error('tipo_sangre')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Agrega el resto de campos con sus respectivas validaciones y mensajes de error -->
                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" name="telefono" id="telefono" class="form-control" required>
                    @error('telefono')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Agrega el resto de campos con sus respectivas validaciones y mensajes de error -->
            @endif

            <!-- Campos del formulario para la solicitud -->
            <div class="form-group">
                <label for="talla">Talla(cm):</label>
                <input type="text" name="talla" id="talla" class="form-control" required>
                @error('talla')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="peso">Peso(Kg):</label>
                <input type="text" name="peso" id="peso" class="form-control" required>
                @error('peso')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group form-check">
                <input type="checkbox" name="acepta_terminos" id="acepta_terminos" class="form-check-input" value="1" required>
                <label class="form-check-label" for="acepta_terminos">Acepta Términos</label>
                @error('acepta_terminos')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Crear Solicitud</button>
        </form>
    </div>
@endsection
