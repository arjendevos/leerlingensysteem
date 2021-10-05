<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Classes
Route::get('/classes', [App\Http\Controllers\ClassesController::class, 'index'])->name('classes.index');
Route::get('/classes/{id}', [App\Http\Controllers\ClassesController::class, 'show'])->name('classes.show');

// Educations
Route::get('/educations', [App\Http\Controllers\EducationController::class, 'index'])->name('educations.index');
Route::get('/educations/{id}', [App\Http\Controllers\EducationController::class, 'show'])->name('educations.show');

// Subjects
Route::get('/subjects', [App\Http\Controllers\SubjectController::class, 'index'])->name('subjects.index');
Route::post('/subjects', [App\Http\Controllers\SubjectController::class, 'store'])->name('subjects.store');
Route::put('/subjects/{id}', [App\Http\Controllers\SubjectController::class, 'update'])->name('subjects.update');
Route::delete('/subjects/{id}', [App\Http\Controllers\SubjectController::class, 'destroy'])->name('subjects.destroy');

// Results
Route::post('/results', [App\Http\Controllers\ResultsController::class, 'store'])->name('results.store');
Route::delete('/results/{id}', [App\Http\Controllers\ResultsController::class, 'destroy'])->name('results.destroy');
Route::put('/results/{id}', [App\Http\Controllers\ResultsController::class, 'update'])->name('results.update');



// Students
Route::get('/student/{id}', [App\Http\Controllers\StudentController::class, 'show'])->name('students.show');
Route::get('/student', [App\Http\Controllers\StudentController::class, 'create'])->name('students.create');
Route::post('/student', [App\Http\Controllers\StudentController::class, 'store'])->name('students.store');
Route::put('/student/{id}', [App\Http\Controllers\StudentController::class, 'update'])->name('students.update');
Route::delete('/student/{id}', [App\Http\Controllers\StudentController::class, 'destroy'])->name('students.destroy');

