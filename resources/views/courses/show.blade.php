@extends('layouts.app')

@section('content')
    <h1>Información del Curso</h1>
    <p><strong>Nombre del Curso:</strong> {{ $course->Name }}</p>
    <p><strong>Número de Asistentes:</strong> {{ $course->Asistentes }}</p>
    <a href="{{ route('courses.index') }}">Volver a la lista de cursos</a>
</div>
