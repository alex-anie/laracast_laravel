<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');
Route::resource('jobs', JobController::class);
Route::view('/contact', 'contact');

// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);

// Route::controller(JobController::class)->group(function(){
//     Route::get('/jobs',  'index');
//     Route::get('/jobs/create',  'create');
//     Route::get('/jobs/{job}',  'show');
//     Route::post('/jobs',  'store');
//     Route::get('/jobs/{job}/edit',  'edit');
//     Route::patch('/jobs/{job}',  'update');
//     Route::delete('/jobs/{job}',  'destroy');
// });

/*
    Commented
Route::resource('jobs', JobController::class, [
    'except' => ['edit']
]);

Route::resource('jobs', JobController::class, [
    'only' => ['index', 'show', 'create', 'store']
]);

*/
