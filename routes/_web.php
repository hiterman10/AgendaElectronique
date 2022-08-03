<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgendaController;

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
    return view('home');
});

//Route pour la creation d'un evement

Route::post('/event/create', [AgendaController::class, 'createEvent']);
Route::get('/event/display', [AgendaController::class, 'displayEvent']);
Route::post('/event/delete', [AgendaController::class, 'deleteEvent']);
