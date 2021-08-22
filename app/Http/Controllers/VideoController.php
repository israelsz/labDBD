<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\User;
use App\Models\UserVideo;
use App\Models\Commentary;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\VideoCategory;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class VideoController extends Controller
{
    public static function index()
    {
        //Se traen todas los videos de la tabla de la base de datos
        $videos = Video::all();

        //Se verifica en caso este vacia
        if(empty($videos)){
            return "No existen videos.";
        }
        return $videos;
    }

    public function store(Request $request)
    {
        $video = new Video();

        $validarDatos = Validator::make($request->all(),[
            'direccion_video' => 'required|max:100',
            'titulo_video' => 'required|max:60',
            'visitas' => 'required',
            'restriccion_edad' => 'required',
            'popularidad' => 'required',
            'cantidad_temporadas' => 'required',
            'descripcion' => 'required|max:500',
            'id_usuario_autor' => 'required',
            'id_comuna' => 'required'
        ],[
            'direccion_video.required' => 'Debe ingresar una direccion de video',
            'direccion_video.max' => 'No puede exceder mas de 100 caracteres',
            'titulo_video.required' => 'Debe ingresar el titulo del video',
            'visitas.required' => 'Debe ingresar el numero de visitas',
            'restriccion_edad.required' => 'Debe ingresar la restriccion de edad 1 o 0',
            'popularidad.required' => 'Debe ingresar el flotante de popularidad entre 0-1',
            'cantidad_temporadas.required' => 'Debe ingresar la cantidad de temporadas',
            'descripcion.required' => 'Debe ingresar la descripcion del video',
            'descripcion.max' => 'La descripcion del video no puede exceder 500 caracteres',
            'id_usuario_autor.required' => 'Debe ingresar el id del usuario que subio el video',
            'id_comuna.required' => 'Debe ingresar el id de la comuna al que pertenece el video'
        ]);

        if ($validarDatos->fails()){
            return response()->json($validarDatos->errors(), 400);
        }
        
        $video->direccion_video = $request->direccion_video;
        $video->titulo_video = $request->titulo_video;
        $video->visitas= $request->visitas;
        $video->restriccion_edad = $request->restriccion_edad;
        $video->popularidad = $request->popularidad;
        $video->cantidad_temporadas = $request->cantidad_temporadas;
        $video->descripcion = $request->descripcion;
        $video->id_usuario_autor= $request->id_usuario_autor;
        $video->id_comuna = $request->id_comuna;

        $video->save();

        return response()->json([
            "message" => "Se ha creado un nuevo video",
            "id" => $video->id
        ]);
    }

    public static function show($id)
    {
        $video = Video::findOrFail($id);
        
        if($video == NULL){
            return "No existe un video asociado a ese id";
        }

        return $video;
    }

    public function update(Request $request, $id)
    {
        $video = Video::find($id);
        
        if($video == NULL){
            return "No existe un video asociada a ese id";
        }
    
        $validarDatos = Validator::make($request->all(),[
            'direccion_video' => 'required|max:100',
            'titulo_video' => 'required|max:60',
            'visitas' => 'required',
            'restriccion_edad' => 'required',
            'popularidad' => 'required',
            'cantidad_temporadas' => 'required',
            'descripcion' => 'required|max:500',
            'id_usuario_autor' => 'required',
            'id_comuna' => 'required'
        ],[
            'direccion_video.required' => 'Debe ingresar una direccion de video',
            'direccion_video.max' => 'No puede exceder mas de 100 caracteres',
            'titulo_video.required' => 'Debe ingresar el titulo del video',
            'visitas.required' => 'Debe ingresar el numero de visitas',
            'restriccion_edad.required' => 'Debe ingresar la restriccion de edad 1 o 0',
            'popularidad.required' => 'Debe ingresar el flotante de popularidad entre 0-1',
            'cantidad_temporadas.required' => 'Debe ingresar la cantidad de temporadas',
            'descripcion.required' => 'Debe ingresar la descripcion del video',
            'descripcion.max' => 'La descripcion del video no puede exceder 500 caracteres',
            'id_usuario_autor.required' => 'Debe ingresar el id del usuario que subio el video',
            'id_comuna.required' => 'Debe ingresar el id de la comuna al que pertenece el video'
        ]);

        if ($validarDatos->fails()){
            return response()->json($validarDatos->errors(), 400);
        }


        $video->direccion_video = $request->direccion_video;
        $video->titulo_video = $request->titulo_video;
        $video->visitas= $request->visitas;
        $video->restriccion_edad = $request->restriccion_edad;
        $video->popularidad = $request->popularidad;
        $video->cantidad_temporadas = $request->cantidad_temporadas;
        $video->descripcion = $request->descripcion;
        $video->id_usuario_autor= $request->id_usuario_autor;
        $video->id_comuna = $request->id_comuna;

        $video->save();
        return response()->json($video);
    }

    public function destroy($id)
    {
        $video = Video::find($id);
        
        if($video == NULL){
            return "No existe un video asociado a ese id";
        }

        $video->delete();
        return response()->json([
            "message" => "Se ha borrado el video",
            "id" => $video->id
        ]);
    }
    public static function ordenadosViews()
    {
        //Se traen todas los videos de la tabla de la base de datos
        $videos = Video::orderBy('visitas','DESC')->get();
        //Se verifica en caso este vacia
        if(empty($videos)){
            return "No existen videos.";
        }
        return $videos;
    }

    public static function vistaVideo($video){

        //Se traen el video de la tabla de la base de datos
        $videoSeleccionado = Video::findOrFail($video);
        $autorVideo = User::findOrFail($videoSeleccionado->id_usuario_autor);
        $feedbackDado = -1;
        $estaSuscrito = 0;

        $edad = 19;
        if (Auth::check()){
            $edad = Carbon::parse(Auth::user()->fecha_nacimiento)->age;
            $visualizacion = new UserVideo();
            $visualizacion->id_usuario = Auth::user()->id;
            $visualizacion->id_video = $videoSeleccionado->id;
            $visualizacion->save();
        }

        $comentariosUnidos = array();
        $comentarios = Commentary::all()->where('id_video', $videoSeleccionado->id);
        $comentadores = array();

        foreach ($comentarios as $aux) {
            if(!empty(UserController::show($aux->id_usuario))){
                $combinacion = array(UserController::show($aux->id_usuario)->username,$aux->contenido);
                array_push($comentariosUnidos, $combinacion);
            }
        }
        
        $likes = Feedback::all()
                        ->where('id_video', $videoSeleccionado->id)
                        ->where('tipo_valoracion', 1)
                        ->count();
        $dislikes = Feedback::all()
                        ->where('id_video', $videoSeleccionado->id)
                        ->where('tipo_valoracion', 0)
                        ->count();
        $categorias = VideoCategory::all()
                        ->where('id_video', $videoSeleccionado->id);   
        $arrayCategorias = array();                            
        foreach ($categorias as $vid) {
            if(!empty(CategoryController::show($vid->id))){
                array_push($arrayCategorias, CategoryController::show($vid->id));
            }
        }
        if (Auth::check()){
            $suscripcion = UserSubscription::all()
                            -> where('id_usuario_suscriptor', Auth::user()->id)
                            -> where('id_usuario_suscripcion', $autorVideo->id);
            if ($suscripcion->isEmpty()){
                     $estaSuscrito = 0;
            }
            else{
                    $estaSuscrito = 1;
            }
            $userFeedback = Feedback::all()
            -> where('id_usuario', Auth::user()->id)
            -> where('id_video', $videoSeleccionado->id)->first();

            if (empty($userFeedback)){
            $feedbackDado = -1;
            }
            else{
            $feedbackDado = $userFeedback->tipo_valoracion;
            }
        }





        return view('watchVideo',
         compact('videoSeleccionado', 'autorVideo', 'comentariosUnidos', 'feedbackDado',
                 'arrayCategorias', 'likes', 'dislikes', 'edad', 'estaSuscrito'));
    }
}
