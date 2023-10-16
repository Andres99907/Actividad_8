<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <ul>
        <li><a href="{{ route('courses.index') }}">Lista de Cursos</a></li>
        <li><a href="{{ route('courses.create') }}">Agregar Curso</a></li>
    </ul>
    
    <div class="container">
        @yield('content')
    </div>
</body>
</html>