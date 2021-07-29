<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Almacenar todos las categorias
        $categorias = Category::all();

        //Indicar con un mensaje en el caso de que no existan categorias
        if ($categorias == NULL){
            return "No exites categorias";
        }
        //Entregar las categorias 
        return response()->json($categorias);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Crear una nueva categoria
        $categoria= new Category();

        $request->validate(
            ['nombre_categoria'=> 'required|max:60'],
            ['nombre_categoria.required'=> 'Debe ingresar un nombre de categoria']
        );
        
        $caregoria->nombre_categoria = $request->nombre_categoria;

        $categoria->save();

        return response()->json([
            "mesagge"=> "Se ha creado una nueva categoria",
            $categoria
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $categoria = Category::find($id);

        if ($categoria==NULL) {
            return "No existe una categoria asociada a esa id";
        }
        return response()->json($categoria);
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
        $categoria = Category::find($id);

        if ($categoria==NULL) {
            return "No existe una categoria asociada a esa id";
        }

        $request->validate(
            ['nombre_categoria'=> 'required|max:60'],
            ['nombre_categoria.required'=> 'Debe ingresar un nombre de categoria']
        );
        
        $caregoria->nombre_categoria = $request->nombre_categoria;

        return response()->json([
            "mesagge"=> "Se ha actualizado una nueva categoria",
            $categoria
        ]);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Category::find($id);

        if ($categoria==NULL) {
            return "No existe una categoria asociada a esa id";
        }

        $categoria->delete();
        return response()->json(
            [
                "message"=> "Se ha borrado la categoria",
                "id" => $categoria->id
            ]);
        
    }
}
