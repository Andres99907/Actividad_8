@extends('layouts.app')

@section('content')
    <h1>Agregar Curso</h1>
    <form method="POST" action="{{ route('courses.store') }}">
        @csrf
        <label for="Name">Nombre del Curso:</label>
        <input type="text" name="Name" required>
        <br>
        <label for="Asistentes">Número de Asistentes:</label>
        <input type="number" name="Asistentes" required>
        <br>
        <button type="submit">Guardar Curso</button>
    </form>
    <a href="{{ route('courses.index') }}">Volver a la lista de cursos</a>
@endsection
