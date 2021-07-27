<?php

use App\Http\Controllers\CommuneController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PlaylistVideoController;
use App\Http\Controllers\UserPlaylistController;
use App\Http\Controllers\CommentaryController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\UserVideoController;
use App\Http\Controllers\UserSubscriptionController;
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

//Rutas para Tabla/Clase Feedback:
Route::get('/feedbacks', [FeedbackController::class, 'index']);
Route::get('/feedbacks/{id}', [FeedbackController::class, 'show']);
Route::post('/feedbacks/create', [FeedbackController::class, 'store']);
Route::put('/feedbacks/update/{id}', [FeedbackController::class, 'update']);
Route::delete('/feedbacks/delete/{id}', [FeedbackController::class, 'destroy']);

//Rutas para Tabla/Clase intermedia PlaylistVideo:
Route::get('/playlist_videos', [PlaylistVideoController::class, 'index']);
Route::get('/playlist_videos/{id}', [PlaylistVideoController::class, 'show']);
Route::post('/playlist_videos/create', [PlaylistVideoController::class, 'store']);
Route::put('/playlist_videos/update/{id}', [PlaylistVideoController::class, 'update']);
Route::delete('/playlist_videos/delete/{id}', [PlaylistVideoController::class, 'destroy']);

//Rutas para Tabla/Clase intermedia UserPlaylist:
Route::get('/user_playlists', [UserPlaylistController::class, 'index']);
Route::get('/user_playlists/{id}', [UserPlaylistController::class, 'show']);
Route::post('/user_playlists/create', [UserPlaylistController::class, 'store']);
Route::put('/user_playlists/update/{id}', [UserPlaylistController::class, 'update']);
Route::delete('/user_playlists/delete/{id}', [UserPlaylistController::class, 'destroy']);

//Rutas para tabla/clase Commentary:
Route::get('/commentaries', [CommentaryController::class, 'index']);//Probado
Route::get('/commentaries/{id}', [CommentaryController::class, 'show']);//Probado
Route::post('/commentaries/create', [CommentaryController::class, 'store']);//Probado
Route::put('/commentaries/update/{id}', [CommentaryController::class, 'update']); //Probado
Route::delete('/commentaries/delete/{id}', [CommentaryController::class, 'destroy']);//Probado
//Rutas para tabla PaymentMethod
Route::get('/payment_methods', [PaymentMethodController::class, 'index']); //Probada
Route::get('/payment_methods/{id}', [PaymentMethodController::class, 'show']);//Probada
Route::post('/payment_methods/create', [PaymentMethodController::class, 'store']);//Probada
Route::put('/payment_methods/update/{id}', [PaymentMethodController::class, 'update']);//Probada
Route::delete('/payment_methods/delete/{id}', [PaymentMethodController::class, 'destroy']);// Probada
//Rutas para tabla UserVideo
Route::get('/user_videos', [UserVideoController::class, 'index']); //Probada
Route::get('/user_videos/{id}', [UserVideoController::class, 'show']);//Probada
Route::post('/user_videos/create', [UserVideoController::class, 'store']);//Probada
Route::put('/user_videos/update/{id}', [UserVideoController::class, 'update']);//Probada
Route::delete('/user_videos/delete/{id}', [UserVideoController::class, 'destroy']);//Probada
//Rutas para tabla userSubscription
Route::get('/user_subscriptions', [UserSubscriptionController::class, 'index']); //Probada
Route::get('/user_subscriptions/{id}', [UserSubscriptionController::class, 'show']);//Probada
Route::post('/user_subscriptions/create', [UserSubscriptionController::class, 'store']);//Probada
Route::put('/user_subscriptions/update/{id}', [UserSubscriptionController::class, 'update']);//Probada
Route::delete('/user_subscriptions/delete/{id}', [UserSubscriptionController::class, 'destroy']);//Probada