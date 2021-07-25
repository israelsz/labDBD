<?php

use App\Http\Controllers\CommuneController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\PlaylistController;
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

//Vista principal
Route::get('/', function () {
    return view('welcome');
});

//Rutas para Tabla/Clase Pais:
//Muestra todos los paises guardados -> Read
Route::get('/countries', [CountryController::class, 'index']);
//Muestra solo un pais, según su id -> Read
Route::get('/countries/{id}', [CountryController::class, 'show']);
//Guarda un nuevo pais -> Create
Route::post('/countries/create', [CountryController::class, 'store']);
//Actualiza un pais -> Update
Route::put('/countries/update/{id}', [CountryController::class, 'update']);
//Borra un pais -> Delete
Route::delete('/countries/delete/{id}', [CountryController::class, 'destroy']);

//Rutas para Tabla/Clase Region:
Route::get('/regions', [RegionController::class, 'index']);
Route::get('/regions/{id}', [RegionController::class, 'show']);
Route::post('/regions/create', [RegionController::class, 'store']);
Route::put('/regions/update/{id}', [RegionController::class, 'update']);
Route::delete('/regions/delete/{id}', [RegionController::class, 'destroy']);

//Rutas para Tabla/Clase Commune:
Route::get('/communes', [CommuneController::class, 'index']);
Route::get('/communes/{id}', [CommuneController::class, 'show']);
Route::post('/communes/create', [CommuneController::class, 'store']);
Route::put('/communes/update/{id}', [CommuneController::class, 'update']);
Route::delete('/communes/delete/{id}', [CommuneController::class, 'destroy']);

//Rutas para Tabla/Clase Video:
Route::get('/videos', [VideoController::class, 'index']);
Route::get('/videos/{id}', [VideoController::class, 'show']);
Route::post('/videos/create', [VideoController::class, 'store']);
Route::put('/videos/update/{id}', [VideoController::class, 'update']);
Route::delete('/videos/delete/{id}', [VideoController::class, 'destroy']);

//Rutas para Tabla/Clase Playlist:
Route::get('/playlists', [PlaylistController::class, 'index']);
Route::get('/playlists/{id}', [PlaylistController::class, 'show']);
Route::post('/playlists/create', [PlaylistController::class, 'store']);
Route::put('/playlists/update/{id}', [PlaylistController::class, 'update']);
Route::delete('/playlists/delete/{id}', [PlaylistController::class, 'destroy']);