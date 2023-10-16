@extends('layouts.app') <!-- Asegúrate de que esta vista extiende tu diseño principal -->

@section('content')
    <h1>Lista de Cursos</h1>
    <ul>
        @foreach ($courses as $course)
            <li><a href="{{ route('courses.show', $course->id) }}">{{ $course->Name }}</a></li>
        @endforeach
    </ul>

    <a href="{{ route('courses.create') }}">Agregar Curso</a>
@endsection
