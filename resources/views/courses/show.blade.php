@extends('layouts.app')

@section('content')
    <h1>Información del Curso</h1>
    <form action="{{ route('courses.update', $course->ID) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <p><strong>ID:</strong> {{ $course->ID }}</p>
    <div class="form-group">
        <p><strong>Nombre del Curso:</strong><input type="text" name="Name" class="form-control" value="{{ $course->Name }}"></p>
    </div>
    <div class="form-group">
        <p><strong>Número de Asistentes:</strong><input type="number" name="Asistentes" class="form-control" value="{{ $course->Asistentes }}"></p>
    </div>
    <div class="form-group">
        <p><strong>Imagen del Curso:</strong><input type="file" name="imagen" class="form-control"></p>
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
</form>
    <br>
    <a class="btn btn-primary" href="{{ route('courses.index') }}">Volver a la lista de cursos</a>
    <form action="{{ route('courses.destroy', $course->ID) }}" method="POST">
    @csrf
    @method('DELETE')
    <br>
    <button class="btn btn-primary" type="submit">Eliminar</button>
    </form>
@endsection
