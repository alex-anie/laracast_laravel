<?php

use App\Models\Job;
use App\Jobs\TranslateJob;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::get('test', function(){
    $job = Job::first();
    TranslateJob::dispatch($job);

    return 'Done';
});

Route::view('/', 'home');
Route::view('/contact', 'contact');

Route::get('/jobs', [JobController::class,'index']);
Route::get('/jobs/create',  [JobController::class, 'create']);
Route::get('/jobs/{job}',  [JobController::class, 'show'])->middleware('auth');
Route::post('/jobs',  [JobController::class, 'store']);
Route::get('/jobs/{job}/edit',  [JobController::class, 'edit'])->middleware('auth')->can('edit','job');
Route::patch('/jobs/{job}',  [JobController::class, 'update']);
Route::delete('/jobs/{job}',  [JobController::class, 'destroy']);

// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);


/*
    Commented
Route::resource('jobs', JobController::class, [
    'except' => ['edit']
]);

Route::resource('jobs', JobController::class, [
    'only' => ['index', 'show', 'create', 'store']
]);

*/
