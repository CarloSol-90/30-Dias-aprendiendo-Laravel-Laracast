<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;


Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->simplePaginate(3); // En esta llamada get, obtenemos cada registro de la tabla de trabajos y mostrrarlos con paginacion.
    //implementamos carga anticipada para la relación employer. trabajo con empleador, dame todos los resultados
    //latest() ordena los resultados por la fecha de creación, de más reciente a más antiguo.

    return view('jobs.index', [
        'jobs' => $jobs //Lo extraemos en su propia variable 
    ]);
});

//ruta para crreear un nuevo empleo
Route::get('/jobs/create', function () {
    return view('jobs.create');
});

//Ruta para mostrar todos los empleos
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

    return view('jobs.show', ['job' => $job]);
});

Route::post('/jobs', function () {
    //validation...

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1,
    ]);

    return redirect('/jobs');
});


Route::get('/contact', function () {
    return view('contact');
});
