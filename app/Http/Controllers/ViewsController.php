<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CommuneController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;
use App\Http\Controllers\EditUserController;
use App\Http\Controllers\CategoryVideoController;
use App\Http\Controllers\CategoryController;
use App\Models\Commentary;
use App\Models\Commune;
use App\Models\Region;
use App\Models\Video;
use App\Models\PaymentMethod;
use App\Models\Donation;
use App\Models\Feedback;
use App\Models\Playlist;
use App\Models\PlaylistVideo;
use App\Models\UserPlaylist;
use App\Models\UserSubscription;
use App\Models\UserType;
use App\Models\Category;
use App\Models\Country;
use App\Models\UserVideo;
use App\Models\VideoCategory;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ViewsController extends Controller
{   
    //Vista indice
    public function vistaIndice(){
        $videos =  VideoController::index();
        return view('index',compact('videos'));
    }

    //Vista login
    public function vistaLogin(){

        return view('login');
    }

    //Vista Register
    public function vistaRegister(){
        //Se consiguen las comunas desde la base de datos
        $comunas = CommuneController::index();

        return view('register',compact('comunas'));
    }

    public function vistaEditarUsuario($user){
        $usuario=User::findOrFail($user);
        $comunas = CommuneController::index();
        $comuna_usuario=Commune::find($usuario->id_comuna);

        return view('editUser',compact('comunas','usuario','comuna_usuario'));
    }

    public function vistaUsuario($id){
        $user = User::find($id);
        $comunas = CommuneController::index();
        $comuna=Commune::find($user->id_comuna);
        return view('userView',compact('user','comuna'));
    }

    //Vista My videos
    public function vistaMyVideos(){
        $videos =  VideoController::index();
        if(!Auth::check()){
            return redirect()->action([ViewsController::class, 'vistaLogin']);
        }
        $videosUser = array();
        foreach($videos as $vid){
            if($vid->id_usuario_autor == Auth::id()){
                array_push($videosUser,$vid);
            }
        }
        return view('myvideos',compact('videosUser'));
    }
    //Vista My videos
    public function vistaEditVideo($id){
        if(!Auth::check()){
            return redirect()->action([ViewsController::class, 'vistaLogin'])->with('Conectarse', 'No conectado, conectese!');
        }
        $video =  VideoController::show($id);
        if(!(Auth::id() == $video->id_usuario_autor)){
            return redirect()->action([ViewsController::class, 'vistaMyVideos'])->with('mensaje', 'No es tu video');
        }
        return view('editvideo',compact('video'));
    }

    public function vistaTopVideos(){
        $videos =  VideoController::ordenadosViews();
        return view('topvideos',compact('videos'));
    }
    public function actualizarVideo(Request $datos, $idVideo){
        if(!(strpos($datos->direccion_video,' ') === false) || (strlen($datos->direccion_video)) != 41 ){
            return back()->with('BadUrl', 'Url invalido!');
        }
        //Se busca al usuario segun su id
        $videoActualizar = VideoController::show($idVideo);

        //Se actualizan sus datos de acuerdo al formulario
        $videoActualizar->titulo_video = $datos->titulo_video;
        $videoActualizar->descripcion = $datos->descripcion;
        $videoActualizar->direccion_video = $datos->direccion_video;

        //Se guardan los cambios en la base de datos
        $videoActualizar->save();

        //Se regresa a la vista anterior
        return redirect()->action([ViewsController::class, 'vistaMyVideos'])->with('mensaje', 'Video actualizado!');
    }
    public function vistaVideosCategoria($id){
        $videos =  CategoryVideoController::videosPorCategoria($id);
        $categorias =  CategoryController::index();
        return view('categoryvideos',compact('videos','categorias'));
    }
    public function refrescarPagina(Request $request){
        $videos =  CategoryVideoController::videosPorCategoria($request->id);
        $categorias =  CategoryController::index();
        return redirect()->action([ViewsController::class, 'vistaVideosCategoria'],['id' =>$request->id])->with('videosCargados', 'Lista de Videos actualizados');
    }
    public function vistaSubirVideo(){
        if(!Auth::check()){
        }
            return redirect()->action([ViewsController::class, 'vistaLogin']);
        return view('uploadvideo');
    }
    public function SubirVideo(Request $request){
        if(!(strpos($request->direccion_video,' ') === false) || (strlen($request->direccion_video)) != 41 ){
            return redirect()->action([ViewsController::class, 'vistaSubirVideo'])->with('BadUrl', 'Url invalido!');
        }
        $videoNuevo = new Video();
        $videoNuevo->descripcion= $request->descripcion;
        $videoNuevo->titulo_video = $request->titulo_video;
        $videoNuevo->direccion_video = $request->direccion_video;
        $videoNuevo->visitas = 0;
        $videoNuevo->restriccion_edad = 0;
        $videoNuevo->popularidad = 0;
        $videoNuevo->cantidad_temporadas = 0;
        $videoNuevo->id_usuario_autor = Auth::id();
        $videoNuevo->id_comuna = Auth::user()->id_comuna;
        $videoNuevo->save();
        return redirect()->action([ViewsController::class, 'vistaMyVideos'])->with('mensaje', 'Video Subido!');
    }




    public function vistaSeguidos(){
        $user_id = Auth::user()->id;

        $canalesSeguidos = UserSubscription::all()
            ->where('id_usuario_suscriptor', $user_id);  
        
        //$usernamessUnidos = array();
        $arrayUsernames = array();                            
        foreach ($canalesSeguidos as $aux) {
            if(!empty(UserController::show($aux->id_usuario_suscripcion))){
                array_push($arrayUsernames, UserController::show($aux->id_usuario_suscripcion));
            }
        }
        return view('seguidos',compact('arrayUsernames'));
    }

    public function vistaListaReproduccion(){
        $listas=Playlist::all();
        return view('playlistView',compact('listas'));
         
    }

    public function vistaVideoListaReproduccion($id){
        $auxs= PlaylistVideo::all()->where('id_playlist',$id);
        $videos=Video::all();
        $videosFiltrados=array();
        foreach ($auxs as $aux){
            foreach ($videos as $video){
                if ($aux->id_video==$video->id) {
                    array_push($videosFiltrados,$video);
                }
            }
        }
        $autores = UserPlaylist::select('id_usuario')->where('id_playlist',$id)->get();

        return view('playlistVideoView',compact('videosFiltrados','autores','id'));
        
    }   

    public function vistaAgregarListaReproduccion(){
        $videos=Video::all();
        return view('createPlaylist',compact('videos'));
    }

    public function agregarListaReproduccion($id_usuario,Request $request){

        $playlist= new Playlist();
        $playlist->nombre_playlist = $request->nombre_playlist;
        $playlist->descripcion_playlist = $request->descripcion_playlist;
        $playlist->save();
        $userPlaylist= new UserPlaylist();
        $userPlaylist->id_playlist = $playlist->id;
        $userPlaylist->id_usuario = $id_usuario;
        $userPlaylist->save();
        
        $videos = $request->input('check_videos');
        foreach ($videos as $video){

            $playlistVideo = new PlaylistVideo();
            $playlistVideo->id_playlist = $playlist->id;
            $playlistVideo->id_video = $video;
            $playlistVideo->save();
        }
        return redirect(route('vistaListaReproduccion'));
    
    }
    
    public function vistaEditarPlaylist($id){
        $playlist=Playlist::find($id);

        $videos=Video::all();
        $video_checked=PlaylistVideo::select('id_video')->where('id_playlist',$id)->get();
        $seleccionados=array();
        foreach ($video_checked as $ckecked){

            array_push($seleccionados,$ckecked->id_video);
        }
        
        return view('editPlaylistView',compact('playlist','videos','seleccionados'));
    }

    public function editarPlaylist($id, Request $request){


        $playlist= Playlist::find($id);
        
    
        if ($request->nombre_playlist!=null) {
            $playlist->nombre_playlist = $request->nombre_playlist;
        }
           
        if ($request->descripcion_playlist!=null) {
            $playlist->descripcion_playlist = $request->descripcion_playlist;
        }
        
        $playlist->save();

        $videos_para_cambiar = $request->input('check_videos_edit');
        $videos_originales = PlaylistVideo::all()->where('id_playlist',$id);
        
    
        if($videos_originales!=null){
            foreach ($videos_originales as $video_original){
                PlaylistVideo::destroy($video_original->id);
            }
        }

        if($videos_para_cambiar!=null){
            foreach($videos_para_cambiar as $video_cambiar){
                $playlistVideo = new PlaylistVideo();
                $playlistVideo->id_playlist = $playlist->id;
                $playlistVideo->id_video = $video_cambiar;
                $playlistVideo->save();
            }
        }
        return redirect(route('vistaListaReproduccion'));
    }

    public function vistaUsers(){

        $usuarios =  UserController::index();

        return view('users',compact('usuarios'));
    }

    public function vistaRecargarSaldo($id){

        $user = User::findOrFail($id);
        $metodosPago = PaymentMethod::all();

        if(Auth::user() == $user){
            return view('recargarSaldo',compact('user','metodosPago'));
        }
        //Si no esta conectado
        return back()->with('logout','No puedes accede a esta vista !');
    }

    public function recargarSaldo(Request $request, $id){

        $user = User::findOrFail($id);

        $validarDatos = Validator::make($request->all(),
            [
                'monto'=>'required|numeric',
            ],
            [
                'monto.numeric'=>'Solo puede ingresar numeros',
                'monto.required'=>'Debe de ingresar un dato al monto'
            ]
        );

        if ($validarDatos->fails()){
            return back()->with('errorMonto', $validarDatos->errors());
        }

        $user->monedero = $user->monedero + $request->monto;

        $user->save();

        return back()->with('saldoRecargado','Se ha efectuado la recarga de saldo!');
    }

    public function vistaDonar($usuarioRecibe){

        $usuarioRecibe = User::findOrFail($usuarioRecibe);
        $metodosPago = PaymentMethod::all();

        if(Auth::check() && $usuarioRecibe->id != Auth::user()->id){
            return view('vistaDonar',compact('usuarioRecibe','metodosPago'));
        }
        //Si no esta conectado
        return back()->with('logout','No puedes acceder a esta pagina !');

    }

    public function donacionConMonedero(Request $request, $usuarioRecibe){

        $usuarioRecibe = User::findOrFail($usuarioRecibe);
        $usuarioDonante = User::findOrFail(Auth::User()->id);

        $donacion = new Donation();

        $validarDatos = Validator::make($request->all(),
        [
            'monto_monedero'=>'required'
        ],  
        [
            'monto_monedero.required'=>'Se debre ingresar un monto de la donacion'
        ]
        );

        if ($validarDatos->fails()){
            return back()->with('logout',$validarDatos->errors());
        }

        if($request->monto_monedero > $usuarioDonante->monedero){
            return back()->with('logout','No puedes donar más dinero que el que tienes en tu monedero');
        }
        
        $donacion->monto = $request->monto_monedero;
        //Se saca la fecha de hoy
        $fecha = Carbon::now()->toDateString();
        $donacion->fecha_donacion = $fecha;
        $donacion->id_donador = $usuarioDonante->id;
        $donacion->id_receptor = $usuarioRecibe->id;
        $donacion->id_metodo_pago = 1;
        $donacion->id_playlist = 1;
        $donacion->id_video = 1;
        $donacion->save();

        return back()->with('saldoRecargado','Has efectuado la donación !');

    }

    public function donacionConTarjeta(Request $request, $usuarioRecibe){

        $usuarioRecibe = User::findOrFail($usuarioRecibe);
        $usuarioDonante = User::findOrFail(Auth::User()->id);

        $donacion = new Donation();

        $validarDatos = Validator::make($request->all(),
        [
            'monto_tarjeta'=>'required',
            'id_metodo_pago_tarjeta'=>'required'
        ],  
        [
            'monto_tarjeta.required'=>'Se debe ingresar un monto de la donacion',
            'id_metodo_pago_tarjeta.required'=>'Debe indicar un metodo de pago'
        ]
        );

        if ($validarDatos->fails()){
            return back()->with('logout',$validarDatos->errors());
        }

        
        $donacion->monto = $request->monto_tarjeta;
        //Se saca la fecha de hoy
        $fecha = Carbon::now()->toDateString();
        $donacion->fecha_donacion = $fecha;
        $donacion->id_donador = $usuarioDonante->id;
        $donacion->id_receptor = $usuarioRecibe->id;
        $donacion->id_metodo_pago = $request->id_metodo_pago_tarjeta;
        $donacion->id_playlist = 1;
        $donacion->id_video = 1;
        $usuarioDonante->monedero = $usuarioDonante->monedero + $request->monto_tarjeta;
        $usuarioDonante->save();
        $donacion->save();

        return back()->with('saldoRecargado','Has efectuado la donación !');

    }

    public function vistaCrudAdmin(){

        if(!Auth::check()){
           return back()->with('logout','No puedes acceder a esta vista');
        }
        //Se verifica si el usuario conectado es admin
        if(Auth::user()->id_tipo_usuario != 3){
            return back()->with('logout','No puedes acceder a esta vista');
        }
        //En caso que sea admin
        $categorias = Category::all();
        $comentarios = Commentary::all();
        $comunas = Commune::all();
        $paises = Country::all();
        $donaciones = Donation::all();
        $feedbacks = Feedback::all();
        $metodosPago = PaymentMethod::all();
        $playlists = Playlist::all();
        $playlistsVideos = PlaylistVideo::all();
        $regiones = Region::all();
        $usuarios = User::all();
        $usuariosPlaylists = UserPlaylist::all();
        $usuarioSubscripciones = UserSubscription::all();
        $usuarioTipos = UserType::all();
        $usuarioVideos = UserVideo::all();
        $videos = Video::all();
        $videoCategorias = VideoCategory::all();

        return(view('vistaCrudAdmin', compact('categorias','comentarios','comunas','paises','donaciones','feedbacks','metodosPago','playlists','playlistsVideos','regiones','usuarios','usuariosPlaylists','usuarioSubscripciones','usuarioTipos','usuarioVideos','videos','videoCategorias')));
    }

    public function vistaEditUsuarioCrud($id){

        $usuario = User::findOrFail($id);
        $comunas = Commune::all();
        return(view('vistaEditUsuarioCrud',compact('usuario','comunas')));
    }



    public function editarUsuarioCrud(Request $request, $id){

        $user = User::findOrFail($id);

        $validarDatos = Validator::make($request->all(),
            [
                'username'=>'required|max:16|unique:users,username',
                'password'=>'required|max:30',
                'fecha_nacimiento'=>'required',
                'email'=>'required|max:30|unique:users,email',
                'id_comuna'=>'required',
            ],
            [
                'username.unique'=>'El nombre de usuario ya existe',
                'username.required'=>'Debe ingresar un nombre de usuario',
                'password.required'=>'Debe ingresar una contraseña',
                'fecha_nacimiento.required'=>'Debe ingresar una fecha de nacimiento',
                'email.required'=>'Debe ingresar un correo electronico',
                'email.unique'=>'El correo electronico ya existe',
                'id_comuna.required'=>'Debe ingresar un id de comuna'
            ]
        );

        if ($validarDatos->fails()){
        //Si el logueo no fue correcto
            return back()->with('registerError', $validarDatos->errors());
        }

        $user->username= $request->username;
        $user->password= Hash::make($request->password); //Se encripta la contraseña
        $user->fecha_nacimiento= $request->fecha_nacimiento;
        $user->email= $request->email;
        $user->id_comuna= $request->id_comuna;

        $user->save();
         
        return redirect()->route('vistaCrudAdmin')->with('register','Datos de usuarios actualizados !');

    }

    public function editarPlaylistCrud(Request $request, $id){

        $playlist = Playlist::findOrFail($id);

        $validarDatos = Validator::make($request->all(),
            [
                'nombre_playlist'=>'required',
                'descripcion_playlist'=>'required',
            ],
            [
                'nombre_playlist.required'=>'Debe ingresar un nombre de playlist',
                'descripcion_playlist.required'=>'Debe ingresar una descripcion',

            ]
        );

        if ($validarDatos->fails()){
        //Si el logueo no fue correcto
            return back()->with('registerError', $validarDatos->errors());
        }

        $playlist->nombre_playlist= $request->nombre_playlist;
        $playlist->descripcion_playlist= $request->descripcion_playlist;

        $playlist->save();
         
        return redirect()->route('vistaCrudAdmin')->with('register','Datos de playlist actualizados!');

    }

    public function vistaEditFeedbackCrud($id){

        $feedback = Feedback::findOrFail($id);
        return(view('vistaEditFeedbackCrud',compact('feedback')));
    }

    public function editarFeedbackCrud(Request $request, $id){

        $feedback = Feedback::findOrFail($id);

        $validarDatos = Validator::make($request->all(),
            [
                'tipo_valoracion'=>'required',
                'id_usuario'=>'required',
                'id_video'=>'required',
            ],
            [
                'tipo_valoracion.required'=>'Debe ingresar un tipo valoracion',
                'id_usuario.required'=>'Debe ingresar una descripcion',
                'id_video.required' =>'Debe ingresar una descripcion',
            ]
        );

        if ($validarDatos->fails()){
        //Si el logueo no fue correcto
            return back()->with('registerError', $validarDatos->errors());
        }

        $feedback->tipo_valoracion= $request->tipo_valoracion;
        $feedback->id_usuario= $request->id_usuario;
        $feedback->id_video= $request->id_video;

        $feedback->save();
         
        return redirect()->route('vistaCrudAdmin')->with('register','Datos de feedback actualizados!');

    }

    public function vistaEditPlaylistCrud($id){

        $playlist = Playlist::findOrFail($id);
        return(view('vistaEditPlaylistCrud',compact('playlist')));
    }
}