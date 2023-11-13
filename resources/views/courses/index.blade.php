@extends('layouts.app') <!-- Asegúrate de que esta vista extiende tu diseño principal -->

@section('content')
    <h1>Lista de Cursos</h1>
    <ul>
        @foreach ($courses as $course)
            <li><a href="{{ route('courses.show', $course->ID) }}">{{ $course->Name }}</a><p>Asistentes: {{ $course->Asistentes }}</p></li>
            @if ($course->Image) <!-- Asegúrate de que existe una imagen -->
            <img src="data:image/jpg;base64,{{ base64_encode($course->Image) }}" alt="Imagen del Curso" style="width: 100px; height: 100px;">
        @endif
        @endforeach
    </ul>
@endsection
