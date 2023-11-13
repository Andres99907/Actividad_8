<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Courses;

class CoursesController extends Controller
{
    // Mostrar la lista de cursos

    public function index()
    {
        $courses = Courses::all();
        return view('courses.index', compact('courses'));
    }

    // Mostrar el formulario para crear un nuevo curso

    public function create()
    {
        return view('courses.create');
    }

    // Almacenar un nuevo curso en la base de datos

    public function store(Request $request)
    {
        // Validación de datos (puedes personalizar según tus necesidades)

        $request->validate([
            'Name' => 'required',
            'Asistentes' => 'required|numeric',
        ]);

        // Crear un nuevo curso en la base de datos

        Courses::create([
            'Name' => $request->input('Name'),
            'Asistentes' => $request->input('Asistentes'),
        ]);

        // Redirigir a la lista de cursos o a donde desees

        return redirect('/courses');
    }

    // Mostrar un curso específico
    
    public function show(Courses $course)
    {
        return view('courses.show', compact('course'));
    }

    // Destruir un elemento

    public function destroy($id){     
    //$course = Courses::find($id);     
    DB::delete('DELETE FROM courses WHERE ID = ?', [$id]);
    // $course->delete(); por alguna razón este delete dejó de funcionar :(
    return redirect('/courses');
    }

    // Actualiza

    public function update(Request $request, $id)
{
    // Valida los datos enviados por el formulario
    $request->validate([
        'Name' => 'required|string',
        'Asistentes' => 'required|integer',
        'imagen' => 'image', // Opcional
    ]);

    // Procesar la imagen si está presente
    if ($request->hasFile('imagen')) {
        $imagen = $request->file('imagen');
        $imagenBinaria = file_get_contents($imagen);

        // Asegúrate de que tu columna pueda almacenar el BLOB
        DB::update('UPDATE courses SET Image = ? WHERE ID = ?', [$imagenBinaria, $id]);
    }

    // Actualizar otros campos
    DB::update('UPDATE courses SET Name = ?, Asistentes = ? WHERE ID = ?', [$request->input('Name'), $request->input('Asistentes'), $id]);
    // Actualiza los campos Name y Asistentes con los datos del formulario
    
    // También esto dejó de jalar :(, ni actualiza nada.
    //$course->update([
    //    'Name' => $request->input('Name'),
    //    'Asistentes' => $request->input('Asistentes'),
    //]);

    // Redirige a la vista de detalle del curso o a donde desees
    return redirect("/courses");
    } 

    public function guardarImagen(Request $request, $id)
    {
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $imagenData = file_get_contents($imagen->getRealPath());

            DB::table('courses')->where('id', $id)->update([
                'IMAGEN' => $imagenData
            ]);

            return 'Imagen subida exitosamente';
        } else {
            return 'No se ha seleccionado ninguna imagen';
        }
    }
}