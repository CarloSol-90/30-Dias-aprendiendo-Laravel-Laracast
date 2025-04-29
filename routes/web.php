<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;


Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function () {
    $jobs = Job::with('employer')->simplePaginate(3); // En esta llamada get, obtenemos cada registro de la tabla de trabajos y mostrrarlos con paginacion.
    //implementamos carga anticipada para la relación employer. trabajo con empleador, dame todos los resultados

    return view('jobs', [
        'jobs' => $jobs //Lo extraemos en su propia variable 
    ]);
});

Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

    return view('job', ['job' => $job]);
});

Route::get('/contact', function () {
    return view('contact');
});
