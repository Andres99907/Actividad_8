<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Controller;
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
}
 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/courses', 'CoursesController@index')->name('courses.index');
Route::get('/courses/create', 'CoursesController@create')->name('courses.create');
Route::post('/courses', 'CoursesController@store')->name('courses.store');
Route::get('/courses/{course}', 'CoursesController@show')->name('courses.show');



Route::get('/', function () {
    return view('welcome');
});
