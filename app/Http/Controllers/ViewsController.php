<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CommuneController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VideoController;
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
    public function vistaVideosCategoria($id){
        $videos =  VideoController::ordenadosViews();
        return view('categoryvideos',compact('videos'));
    }

}
