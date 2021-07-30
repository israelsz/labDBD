<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VideoCategory;
use Illuminate\Support\Facades\Validator;

class VideoCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $videoCategoria = videoCategory::all();

        if ($videoCategoria==NULL) {
            return response()->json(["message"=> "No exiten video-categorias"],404);
        }
        return response()->json($videoCategoria);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $videoCategoria = new VideoCategoria();
        $request->validate([
                'id_video'=>'required',
                'id_categoria'=>'required'
            ],[
                'id_video.required'=> 'Debe ingresar el id del video',
                'id_categoria.required'=>'Debe ingresar el id de  la categoria'
            ]);

        if ($validarDatos->fails()){
            return response()->json($validarDatos->errors(), 400);
        }

        $videoCategoria->id_video= $request->id_video;
        $videoCategoria->id_categoria= $request->id_categoria;
        $videoCategoria->save();
        return response()->json([
            "message"=> "Se ha creado un nuevo video-categoria",
            $videoCategoria
        ],202);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $videoCategoria= VideoCategory::find($id);
        if ($videoCategoria==NULL) {
            return response()->json(["message"=> "No exiten video-categorias asociadas a la id ingresada"],404);
        }

        return response()->json($videoCategoria);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $videoCategoria= VideoCategory::find($id);
        if ($videoCategoria==NULL) {
            return response()->json(["message"=> "No exiten video-categorias asociadas a la id ingresada"],404);
        }

        $validarDatos = Validator::make($request->all(),[
            'id_video'=>'required',
            'id_categoria'=>'required'
        ],[
            'id_video.required'=> 'Debe ingresar el id del video',
            'id_categoria.required'=>'Debe ingresar el id de  la categoria'
        ]);

        if ($validarDatos->fails()){
            return response()->json($validarDatos->errors(), 400);
        }

        $videoCategoria->id_video= $request->id_video;
        $videoCategoria->id_categoria= $request->id_categoria;
        $videoCategoria->save();
        return response()->json([
            "message"=> "Se ha actualizado un video-categoria",
            $videoCategoria
        ],202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $videoCategoria=VideoCategoria::find($id);

        if ($videoCategoria==NULL) {
            return response()->json(["message"=> "No exiten video-categorias asociadas a la id ingresada"],404);
        }

        $videoCategoria->delete();
        return response()->json(
            [
                "message"=>"Se ha borrado la categoria",
                "id"=>$videoCategoria->id
            ],202);
    }
}
