<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
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

        $reglas = [
            'Name' => 'required|string|min:5',
            'Asistentes' => 'required|integer|min:1',
            'imagen' => 'required|image|mimes:jpeg|max:500',
        ];

        // Mensajes de error

    $mensajes = [
        'Name.required' => 'El de nombre es obligatorio.',
        'Name.min' => 'El campo de nombre debe tener al menos :min caracteres.',
        'Asistentes.required' => 'El número de asistentes es obligatorio',
        'Asistentes.min' => 'Debe haber al menos un asistente',
        'imagen.required' => 'Debes de seleccionar una imagen',
        'imagen.mimes' => 'La imagen debe ser de tipo JPEG.',
        'imagen.max' => 'La imagen no debe ser mayor de 500 KB.',
    ];

    // Si falla entonces devuelve un error

    $validator = Validator::make($request->all(), $reglas, $mensajes);

    if ($validator->fails()) {
        // Si la validación falla, redirige de nuevo al formulario con los errores
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Crear un nuevo curso en la base de datos

    $nuevoCurso = Courses::create([
        'Name' => $request->input('Name'),
        'Asistentes' => $request->input('Asistentes'),
    ]);

    $imagen = $request->file('imagen');

    // Verifica el tamaño antes de almacenarla en la base de datos
    if ($imagen->getSize() > 500 * 1024) {
        // Si la imagen es mayor a 500 KB, devuelve un mensaje de error
        return redirect()->back()->withErrors(['imagen' => 'La imagen no debe ser mayor de 500 kb.'])->withInput();
    }

    $imagenBinaria = file_get_contents($imagen);
    

    try{
        DB::update('UPDATE courses SET Image = ? WHERE ID = ?', [$imagenBinaria, $nuevoCurso->id]);
    } 
    catch (\Exception $e) {
    // Maneja la excepción aquí
    return redirect()->back()->withErrors(['imagen' => 'El curso fue creado, sin embargo no se pudo subir la imagen.'])->withInput();
    }

        

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
    $reglas = [
        'Name' => 'required|string|min:5',
        'Asistentes' => 'required|integer|min:1',
        'imagen' => 'required|image|mimes:jpeg|max:500',
    ];

    // Mensajes de error

    $mensajes = [
        'Name.required' => 'El de nombre es obligatorio.',
        'Name.min' => 'El campo de nombre debe tener al menos :min caracteres.',
        'Asistentes.required' => 'El número de asistentes es obligatorio',
        'Asistentes.min' => 'Debe haber al menos un asistente',
        'imagen.required' => 'Debes de seleccionar una imagen',
        'imagen.mimes' => 'La imagen debe ser de tipo JPEG.',
        'imagen.max' => 'La imagen no debe ser mayor de 500 KB.',
    ];

    // Si falla entonces devuelve un error

    $validator = Validator::make($request->all(), $reglas, $mensajes);

    if ($validator->fails()) {
        // Si la validación falla, redirige de nuevo al formulario con los errores
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $imagen = $request->file('imagen');

    // Verifica el tamaño antes de almacenarla en la base de datos
    if ($imagen->getSize() > 500 * 1024) {
        // Si la imagen es mayor a 500 KB, devuelve un mensaje de error
        return redirect()->back()->withErrors(['imagen' => 'La imagen no debe ser mayor de 500 kb.'])->withInput();
    }


    $imagenBinaria = file_get_contents($imagen);

    // Asegúrate de que tu columna pueda almacenar el BLOB
    try{
    DB::update('UPDATE courses SET Image = ? WHERE ID = ?', [$imagenBinaria, $id]);
    } 
    catch (\Exception $e) {
    // Maneja la excepción aquí
    return redirect()->back()->withErrors(['imagen' => 'Ha ocurrido un error al subir la imagen, intenta seleccionar una diferente'])->withInput();
    }
    // Actualizar otros campos

    DB::update('UPDATE courses SET Name = ?, Asistentes = ? WHERE ID = ?', [$request->input('Name'), $request->input('Asistentes'), $id]);

    return redirect("/courses");

    } 
}