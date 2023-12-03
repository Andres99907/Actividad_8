@extends('layouts.app')

@section('content')
    <h1>Agregar curso</h1>
    <form method="POST" action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="Name">Nombre del curso:</label>
        <br>
        <input type="text" class="form-control" name="Name" required>
        <br>
        <label for="Asistentes">Número de asistentes:</label>
        <br>
        <input type="number" class="form-control" name="Asistentes" required>
        <br>
        <label for="Asistentes">Imagen del curso:</label><input type="file" name="imagen" class="form-control" accept="image/jpeg"></p>
        @error('imagen')
        <span class="error">{{ $message }}</span>
        @enderror
        <br/>
        <button class="btn btn-primary" type="submit">Guardar curso</button>
    </form>
@endsection
