<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

// Index :: get all jobs
Route::get('/jobs', function ()  {
    $jobs = Job::with('employer')->latest()->simplePaginate(3);

    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

// Create :: display a form to create a job
Route::get('/jobs/create', function(){
    return view('jobs.create');
});

// Show :: display a page of a specific job selected
Route::get('/jobs/{id}', function ($id)  {
    $job = Job::find($id);
    return view('jobs.show', ['job' => $job]);
});

// Store :: this story a new job entery into the Database.
Route::post('/jobs', function(){
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);
    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);

    return redirect('/jobs');
});

// Edit :: display a page of a specific job for editing
Route::get('/jobs/{id}/edit', function ($id)  {
    $job = Job::find($id);
    return view('jobs.edit', ['job' => $job]);
});

// Update :: create the action to update the page
Route::patch('/jobs/{id}', function ($id)  {
   // validate
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

   // authorize (on hold ...)

   // update the job
   $job = Job::findOrFail($id);

   $job->update([
        'title' => request('title'),
        'salary' => request('salary')
   ]);

   // redirect to the job patch
    return redirect('/jobs/' . $job->id);
});

// Destroy :: Delete a record from the database
Route::delete('/jobs/{id}', function ($id)  {
    // authorize the hold ...

    // delete the job
    Job::findOrFail($id)->delete();

    // redirect
    return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});
