<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;


Route::get('/', function () {
    return view('home');
});

//Index -- Ruta para mostrar la lista de trabajos
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->simplePaginate(3); // En esta llamada get, obtenemos cada registro de la tabla de trabajos y mostrrarlos con paginacion.
    //implementamos carga anticipada para la relación employer. trabajo con empleador, dame todos los resultados
    //latest() ordena los resultados por la fecha de creación, de más reciente a más antiguo.

    return view('jobs.index', [
        'jobs' => $jobs //Lo extraemos en su propia variable 
    ]);
});

//Create -- ruta para crear un nuevo empleo
Route::get('/jobs/create', function () {
    return view('jobs.create');
});

//Show -- Ruta para mostrar un trabajo específico
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

    return view('jobs.show', ['job' => $job]);
});

//Store -- Ruta para almacenar un nuevo trabajo
Route::post('/jobs', function () {
    //validation
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required'],
    ]);

    Job::create([ //Creamos un nuevo registro en la tabla de trabajos
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1,
    ]);

    return redirect('/jobs'); //Redirigimos a la ruta de trabajos después de crear un nuevo trabajo
});

//Edit -- Ruta para editar un trabajo específico
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);

    return view('jobs.edit', ['job' => $job]);
});

//Update -- Ruta para actualizar un trabajo específico
Route::patch('/jobs/{id}', function ($id) {
    //patch es un método HTTP que se utiliza para aplicar modificaciones parciales a un recurso existente. En este caso, se utiliza para actualizar un trabajo específico en la base de datos.
    //1. Validate
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required'],
    ]);
    //2. authorize (On hold... )

    //3. update the job
    $job = Job::findOrFail($id); //findOrFail busca un registro por su ID y lanza una excepción si no se encuentra. Esto es útil para manejar errores de manera más efectiva.

    $job->update([
        'title' => request('title'),
        'salary' => request('salary')
    ]);

    //5. redirect to the job page
    return redirect('/jobs/' . $job->id); //Redirigimos a la página del trabajo después de actualizarlo
});


//Destroy -- Ruta para eliminar un trabajo específico
Route::delete('/jobs/{id}', function ($id) {

    Job::findOrFail($id)->delete();

    return redirect('/jobs'); //Redirigimos a la lista de trabajos después de eliminar el trabajo
});
//delete es un método HTTP que se utiliza para eliminar un recurso específico en la base de datos. En este caso, se utiliza para eliminar un trabajo específico.

Route::get('/contact', function () { //ruta para mostrar el formulario de contacto
    return view('contact');
});
