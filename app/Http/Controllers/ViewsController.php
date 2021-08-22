<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CommuneController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\EditUserController;
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
        
        return view('index');
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
        //$userOn = Auth::user();
        $videosUser =  VideoController::index();
        /*
        $videosUser = array();
        if(!empty($userOn)){
            foreach($videos as $vid){
                if($vid->id_usuario_autor == $userOn->id){
                    array_push($videosUser,$vid);
                }

            }
        }
        */
        return view('myvideos',compact('videosUser'));
    }
    //Vista My videos
    public function vistaEditVideo($id){
        $video =  VideoController::show($id);
        return view('editvideo',compact('video'));
    }

    public function vistaTopVideos(){
        $videos =  VideoController::ordenadosViews();
        return view('topvideos',compact('videos'));
    }
    public function actualizarVideo(Request $datos, $idVideo){
        //Se busca al usuario segun su id
        $videoActualizar = VideoController::show($idVideo);

        //Se actualizan sus datos de acuerdo al formulario
        $videoActualizar->titulo_video = $datos->titulo_video;
        $videoActualizar->descripcion = $datos->descripcion;

        //Se guardan los cambios en la base de datos
        $videoActualizar->save();

        //Se regresa a la vista anterior
        return redirect()->action([ViewsController::class, 'vistaMyVideos'])->with('mensaje', 'Video actualizado!');
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
}
