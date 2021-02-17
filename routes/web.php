<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\NeighbourController;
use App\Http\Controllers\NoteController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [HomeController::class, 'index'])
->name('home')
->middleware(['auth']);

Route::resource('members', MemberController::class)
->middleware(['auth']);

Route::resource('neighbours', NeighbourController::class)
->middleware(['auth']);

Route::get('notes', [NoteController::class, 'index'])
->name('notes.index')
->middleware(['auth']);

Route::resource('neighbours.notes', NoteController::class)
->scoped()
->middleware(['auth']);

