@extends('layouts.app')

@section('content')
    <h1>Agregar Curso</h1>
    <form method="POST" action="{{ route('courses.store') }}">
        @csrf
        <label for="Name">Nombre del Curso:</label>
        <br>
        <input type="text" name="Name" required>
        <br>
        <label for="Asistentes">Número de Asistentes:</label>
        <br>
        <input type="number" name="Asistentes" required>
        <br>
        <br>
        <button class="btn btn-primary" type="submit">Guardar Curso</button>
    </form>
@endsection
