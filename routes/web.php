<?php

use App\Http\Controllers\ProblemController;
use App\Models\Problem;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProblemExportCSVController;

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

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/', function () {
    return redirect('/problems');
});

Route::get('/home',function (){
    return redirect('/problems');
});

Route::get('/problems', function () {
    return view('layouts.main');
});

Route::resource('problems', ProblemController::class);
Route::resource('departments', \App\Http\Controllers\DepartmentController::class);
Route::resource('users', \App\Http\Controllers\UserController::class);

Route::PUT('/problems/{problem}/upvote', [ProblemController::class, 'upvote'])
    ->name('problems.upvote')->middleware('auth');

Route::resource('/categories', \App\Http\Controllers\CategoryController::class);

Route::get('your_problems', [\App\Http\Controllers\ProblemController::class, 'your_problems'])->name('your_problems');

Route::PUT('/problems/{problem}/ignored', [ProblemController::class, 'ignoredProblem'])
    ->name('problems.ignored')->middleware('auth');

Route::PUT('/problems/{problem}/inprogress', [ProblemController::class, 'acceptProblem'])
    ->name('problems.accept')->middleware('auth');

Route::PUT('/problems/{problem}/complete', [ProblemController::class, 'completeProblem'])
    ->name('problems.complete')->middleware('auth');

Route::get('/sortCountLike', [\App\Http\Controllers\ProblemController::class, 'sortCountLike'])->name('problems.sortCountLike');

Route::get('/dashboard', [ProblemController::class, 'dashboard'])->name('problems.dashboard');

Route::get('excel-csv-file', [ProblemExportCSVController::class, 'index']);
Route::get('export-excel-csv-file/{slug}', [ProblemExportCSVController::class, 'exportExcelCSV']);
