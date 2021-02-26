<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\NeighbourController;
use App\Http\Controllers\NoteController;
use App\Models\Neighbour;
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

Route::resource('addresses', AddressController::class)
->middleware(['auth']);

Route::get('/neighbours/enable/{neighbour}/{value}', [NeighbourController::class, 'enable'])
->name('neighbours.enable')
->middleware(['auth']);

Route::get('/neighbours/restore/{neighbour_id}', [NeighbourController::class, 'restore'])
->name('neighbours.restore')
->middleware(['auth']);

Route::get('notes', [NoteController::class, 'index'])
->name('notes.index')
->middleware(['auth']);

Route::resource('neighbours.notes', NoteController::class)
->scoped()
->middleware(['auth']);

Route::get('map', [MapController::class, 'index'])
->name('map.index')
->middleware(['auth']);
