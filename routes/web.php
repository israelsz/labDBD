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
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\VideoCategoryController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ViewsController;
use App\Http\Controllers\EditUserController;
use App\Http\Controllers\CategoryVideoController;
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

//Rutas para vistas


Route::get('/', [ViewsController::class, 'vistaIndice'])->name('vistaIndice');
Route::get('/login', [ViewsController::class, 'vistaLogin'])->name('vistaLogin');
Route::get('/register', [ViewsController::class, 'vistaRegister'])->name('vistaRegister');
Route::get('/myvideos', [ViewsController::class, 'vistaMyVideos'])->name('vistaMyVideos');
Route::get('/editvideo/{id}', [ViewsController::class, 'vistaEditVideo'])->name('vistaEditVideo');
Route::get('/topvideos', [ViewsController::class, 'vistaTopVideos'])->name('vistaTopVideos');
Route::get('/categoryvideos/{id}', [ViewsController::class, 'vistaVideosCategoria'])->name('vistaVideosCategoria');
Route::get('/user/{id}',[ViewsController::class, 'vistaUsuario'])->name('vistaUsuario');
Route::get('/user/{id}/editUser',[ViewsController::class, 'vistaEditarUsuario'])->name('vistaEditarUsuario');
Route::get('/watchVideo/{id}', [VideoController::class, 'vistaVideo'])->name('vistaVideo');
Route::put('/video/update/{id}', [ViewsController::class, 'actualizarVideo'])->name('updateVideo');
Route::get('/seguidos', [ViewsController::class, 'vistaSeguidos'])->name('vistaSeguidos');
Route::get('/uploadvideo', [ViewsController::class, 'vistaSubirVideo'])->name('vistaSubirVideo');
Route::post('/uploadvideo/create', [ViewsController::class, 'SubirVideo'])->name('SubirVideo');
Route::get('/list', [ViewsController::class, 'vistaListaReproduccion'])->name('vistaListaReproduccion');
Route::get('/users', [ViewsController::class, 'vistaUsers'])->name('vistaUsuarios');
Route::get('/cargarSaldo/{id}', [ViewsController::class, 'vistaRecargarSaldo'])->name('vistaRecargarSaldo');
Route::put('/cargarSaldo/update/{id}', [ViewsController::class, 'recargarSaldo'])->name('recargarSaldo');
Route::get('/donar/{id}/', [ViewsController::class, 'vistaDonar'])->name('vistaDonar');
Route::post('/donar/monedero/{id}/', [ViewsController::class, 'donacionConMonedero'])->name('donacionConMonedero');
Route::post('/donar/tarjeta/{id}/', [ViewsController::class, 'donacionConTarjeta'])->name('donacionConTarjeta');
Route::get('/adminCrud', [ViewsController::class, 'vistaCrudAdmin'])->name('vistaCrudAdmin');
Route::get('/adminCrud/user/edit/{id}', [ViewsController::class, 'vistaEditUsuarioCrud'])->name('vistaEditUsuarioCrud');
Route::put('/adminCrud/user/edit/execute/{id}', [ViewsController::class, 'editarUsuarioCrud'])->name('editarUsuarioCrud');
Route::get('/adminCrud/playlists/edit/{id}', [ViewsController::class, 'vistaEditPlaylistCrud'])->name('vistaEditPlaylistCrud');
Route::put('/adminCrud/playlists/edit/execute/{id}', [ViewsController::class, 'editarPlaylistCrud'])->name('editarPlaylistCrud');
Route::get('/adminCrud/feedbacks/edit/{id}', [ViewsController::class, 'vistaEditFeedbackCrud'])->name('vistaEditFeedbackCrud');
Route::put('/adminCrud/feedbacks/edit/execute/{id}', [ViewsController::class, 'editarFeedbackCrud'])->name('editarFeedbackCrud');
Route::post('/adminCrud/video/crear',[ViewsController::class, 'crearVideo'])->name('crearVideo');
Route::get('/adminCrud/video/edit/{id}', [ViewsController::class, 'viewEditarVideo'])->name('vistaEditarVideo');
Route::get('/adminCrud/userType/edit/{id}', [ViewsController::class, 'viewEditarTipoUsuario'])->name('viewEditarTipoUsuario');
Route::get('/adminCrud/donacion/edit/{id}', [ViewsController::class, 'vistaEditarDonacion'])->name('vistaEditarDonacion');
Route::put('/adminCrud/country/create', [ViewsController::class, 'RegisterCrudPais'])->name('RegisterCrudPais');
Route::get('/adminCrud/country/edit/{id}', [ViewsController::class, 'vistaEditPaisCrud'])->name('vistaEditPaisCrud');
Route::put('/adminCrud/country/edit/execute/{id}', [ViewsController::class, 'editCrudPais'])->name('editCrudPais');
Route::get('/adminCrud/region/edit/{id}', [ViewsController::class, 'vistaEditRegionCrud'])->name('vistaEditRegionCrud');
Route::get('/adminCrud/comuna/edit/{id}', [ViewsController::class, 'vistaEditComunaCrud'])->name('vistaEditComunaCrud');
Route::get('/adminCrud/comentario/edit/{id}', [ViewsController::class, 'vistaEditComentarioCrud'])->name('vistaEditComentarioCrud');



Route::get('/adminCrud/metodos/edit/{id}', [ViewsController::class, 'vistaEditMetodosCrud'])->name('vistaEditMetodosCrud');
Route::get('/adminCrud/categoria/edit/{id}', [ViewsController::class, 'vistaEditCategoriaCrud'])->name('vistaEditCategoriaCrud');
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
Route::delete('/countries/delete/{id}', [CountryController::class, 'destroy'])->name('eliminarPais');

//Rutas para Tabla/Clase Region:
Route::get('/regions', [RegionController::class, 'index']);
Route::get('/regions/{id}', [RegionController::class, 'show']);
Route::post('/regions/create', [RegionController::class, 'store'])->name('storeRegion');
Route::put('/regions/update/{id}', [RegionController::class, 'update'])->name('updateRegion');
Route::delete('/regions/delete/{id}', [RegionController::class, 'destroy'])->name('eliminarRegion');

//Rutas para Tabla/Clase Commune:
Route::get('/communes', [CommuneController::class, 'index']);
Route::get('/communes/{id}', [CommuneController::class, 'show']);
Route::post('/communes/create', [CommuneController::class, 'store'])->name('storeComuna');
Route::put('/communes/update/{id}', [CommuneController::class, 'update'])->name('updateComuna');
Route::delete('/communes/delete/{id}', [CommuneController::class, 'destroy'])->name('eliminarComuna');

//Rutas para Tabla/Clase Video:
Route::get('/videos', [VideoController::class, 'index']);
Route::get('/videos/{id}', [VideoController::class, 'show']);
Route::post('/videos/create', [VideoController::class, 'store']);
Route::put('/videos/update/{id}', [VideoController::class, 'update'])->name('editarVideo');
Route::delete('/videos/delete/{id}', [VideoController::class, 'destroy'])->name('eliminarVideo');;

//Rutas para Tabla/Clase Playlist:
Route::get('/playlists', [PlaylistController::class, 'index']);
Route::get('/playlists/{id}', [PlaylistController::class, 'show']);
Route::post('/playlists/create', [PlaylistController::class, 'store'])->name('CrearPlaylist');
Route::post('/playlists/CreateCrud', [PlaylistController::class, 'store'])->name('CrearPlaylistCrud');
Route::put('/playlists/update/{id}', [PlaylistController::class, 'update']);
Route::delete('/playlists/delete/{id}', [PlaylistController::class, 'destroy'])->name('EliminarPlaylist');

//Rutas para Tabla/Clase Feedback:
Route::get('/feedbacks', [FeedbackController::class, 'index']);
Route::get('/feedbacks/{id}', [FeedbackController::class, 'show']);
Route::post('/feedbacks/CreateCrud', [FeedbackController::class, 'store'])->name('CrearFeedbackCrud');
Route::post('/feedbacks/create/{tipo_valoracion}/{id_usuario}/{id_video}', [FeedbackController::class, 'store'])->name('HacerFeedback');
Route::put('/feedbacks/update/{id}', [FeedbackController::class, 'update']);
Route::delete('/feedbacks/delete/{id}', [FeedbackController::class, 'destroy'])->name('EliminarFeedback');

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
Route::post('/commentaries/create/{id_video}/{id_usuario}', [CommentaryController::class, 'store'])->name('HacerComentario');
Route::post('/commentaries/create/', [CommentaryController::class, 'storeComment'])->name('storeComentario');
Route::put('/commentaries/update/{id}', [CommentaryController::class, 'update'])->name('updateComentario');
Route::delete('/commentaries/delete/{id}', [CommentaryController::class, 'destroy'])->name('eliminarComentario');
//Rutas para tabla PaymentMethod
Route::get('/payment_methods', [PaymentMethodController::class, 'index']); //Probada
Route::get('/payment_methods/{id}', [PaymentMethodController::class, 'show']);//Probada
Route::post('/payment_methods/create', [PaymentMethodController::class, 'store'])->name('CrearMetodoPago');//Probada
Route::put('/payment_methods/update/{id}', [PaymentMethodController::class, 'update'])->name('editarMetodoPago');//Probada
Route::delete('/payment_methods/delete/{id}', [PaymentMethodController::class, 'destroy'])->name('eliminarMetodo');// Probada
//Rutas para tabla UserVideo
Route::get('/user_videos', [UserVideoController::class, 'index']); //Probada
Route::get('/user_videos/{id}', [UserVideoController::class, 'show']);//Probada
Route::post('/user_videos/create', [UserVideoController::class, 'store']);//Probada
Route::put('/user_videos/update/{id}', [UserVideoController::class, 'update']);//Probada
Route::delete('/user_videos/delete/{id}', [UserVideoController::class, 'destroy']);//Probada
//Rutas para tabla userSubscription
Route::get('/user_subscriptions', [UserSubscriptionController::class, 'index']); //Probada
Route::get('/user_subscriptions/{id}', [UserSubscriptionController::class, 'show']);//Probada
Route::post('/user_subscriptions/create/{id_suscriptor}/{id_suscripcion}', [UserSubscriptionController::class, 'store'])->name('HacerSuscripcion');
Route::put('/user_subscriptions/update/{id}', [UserSubscriptionController::class, 'update']);//Probada
Route::delete('/user_subscriptions/delete/{id}', [UserSubscriptionController::class, 'destroy']);//Probada

//Rutas para tabla Category
Route::get('/categories', [CategoryController::class, 'index']); 
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::post('/categories/create', [CategoryController::class, 'store'])->name('crearCategoria');
Route::put('/categories/update/{id}', [CategoryController::class, 'update'])->name('editarCategoria');
Route::delete('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('eliminarCategoria');

//Rutas para la table VideoCategory
Route::get('/video_categories', [VideoCategoryController::class, 'index']); 
Route::get('/video_categories/video/{id}', [VideoCategoryController::class, 'videosDeCategoria']); 
Route::get('/video_categories/{id}', [VideoCategoryController::class, 'show']);
Route::post('/video_categories/create', [VideoCategoryController::class, 'store']);
Route::put('/video_categories/update/{id}', [VideoCategoryController::class, 'update']);
Route::delete('/video_categories/delete/{id}', [VideoCategoryController::class, 'destroy']);

//Rutas para la tabla UserType
Route::get('/user_types', [UserTypeController::class, 'index']);
Route::get('/user_types/{id}', [UserTypeController::class, 'show']);
Route::post('/user_types/create', [UserTypeController::class, 'store'])->name('crearTipoUsuario'); 
Route::put('/user_types/update/{id}', [UserTypeController::class, 'update'])->name('editarTipoUsuario');
Route::delete('/user_types/delete/{id}', [UserTypeController::class, 'destroy'])->name('eliminarTipousuario');

//Rutas para la table User
//Route::get('/users', [UserController::class, 'index']); 
Route::get('/users/{id}', [UserController::class, 'show']);
Route::post('/users/create', [UserController::class, 'store'])->name('intentarRegister');
Route::post('/users/createCrud', [UserController::class, 'storeAdmin'])->name('intentarRegisterCrud');
Route::put('/users/update/{id}', [UserController::class, 'update']);
Route::delete('/users/delete/{id}', [UserController::class, 'destroy'])->name('eliminarUsuario');

//Rutas para la tabla Donation
Route::get('/donations', [DonationController::class, 'index']); 
Route::get('/donations/{id}', [DonationController::class, 'show']);
Route::post('/donations/create', [DonationController::class, 'store'])->name('crearDonacion');
Route::put('/donations/update/{id}', [DonationController::class, 'update'])->name('editarDonacion');
Route::delete('/donations/delete/{id}', [DonationController::class, 'destroy'])->name('eliminarDonacion');

//Ruta para Login
Route::post('/login/attempt', [LoginController::class, 'login'])->name('intentarLogin');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::put('user/{id}/editUser/attempt',[EditUserController::class, 'update'])->name('intentarEditarUsuario');
Route::get('/list/{id}',[ViewsController::class, 'vistaVideoListaReproduccion'])->name('vistaVideoListaReproduccion');
Route::get('/listAdd',[ViewsController::class, 'vistaAgregarListaReproduccion'])->name('vistaAgregarListaReproduccion');
Route::post('/listAdd/attemp/{id}',[ViewsController::class, 'agregarListaReproduccion'])->name('agregarListaReproduccion');
Route::get('/list/{id}/edit', [ViewsController::class, 'vistaEditarPlaylist'])->name('vistaEditarPlaylist');
Route::put('/list/{id}/edit/attemp',[ViewsController::class, 'editarPlaylist'])->name('editarPlaylist');
//Ruta para CategoryVideo
Route::get('/categoryVideo/{id}', [CategoryVideoController::class, 'videosPorCategoria']);
Route::get('/refrescarPagina', [ViewsController::class, 'refrescarPagina'])->name('refrescarPagina');

