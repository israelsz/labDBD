<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donaciones = Donation::all();

        //Indicar con un mensaje en el caso de que no existan donaciones
        if ($donaciones == NULL){
            return "No exiten donaciones";
        }
        //Entregar las donaciones 
        return response()->json($donaciones);
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
        $donacion= new Donation();

        $request->validate(
            [
                'monto'=>'required',
                'fecha_donacion'=>'required',
                'id_donador'=>'required',
                'id_receptor'=>'required',
                'id_metodo_pago'=>'required',
                'id_playlist'=>'required',
                'id_video'=>'required'
            ],
            [
                'monto.required'=>'Se debre ingresar un monto de la donacion',
                'fecha_donacion.required'=>'Se debre ingresar una fecha de donacion',
                'id_donador.required'=>'Se debre ingresar una id de donador',
                'id_receptor.required'=>'Se debre ingresar una id de receptor',
                'id_metodo_pago.required'=>'Se debre ingresar una id de metodo de pago',
                'id_playlist.required'=>'Se debre ingresar id de lista de reproduccion',
                'id_video.required'=>'Se debre ingresar de video'   
            ]
        
            );
        
        $donacion->monto = $request->monto;
        $donacion->fecha_donacion= $request->fecha_donacion;
        $donacion->id_donador= $request->id_donador;
        $donacion->id_receptor= $request->id_receptor;
        $donacion->id_metodo_pago= $request->id_metodo_pago;
        $donacion->id_playlist= $request->id_playlist;
        $donacion->id_video= $request->id_video;
        $donacion->save();

        return response()->json([
            "mesagge"=> "Se ha creado una nueva donacion",
            $donacion
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
        $donacion= Donation::find($id);

        if ($donacion==NULL) {
            return "No existe una donacion asociada al usuario ingresado";
        }

        return $reponse()->json($donacion);
    
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
        $donacion= Donation::find($id);

        if ($donacion==NULL) {
            return "No existe una donacion asociada al usuario ingresado";
        }

        $request->validate(
            [
                'monto'=>'required',
                'fecha_donacion'=>'required',
                'id_donador'=>'required',
                'id_receptor'=>'required',
                'id_metodo_pago'=>'required',
                'id_playlist'=>'required',
                'id_video'=>'required'
            ],
            [
                'monto.required'=>'Se debre ingresar un monto de la donacion',
                'fecha_donacion.required'=>'Se debre ingresar una fecha de donacion',
                'id_donador.required'=>'Se debre ingresar una id de donador',
                'id_receptor.required'=>'Se debre ingresar una id de receptor',
                'id_metodo_pago.required'=>'Se debre ingresar una id de metodo de pago',
                'id_playlist.required'=>'Se debre ingresar id de lista de reproduccion',
                'id_video.required'=>'Se debre ingresar de video'   
            ]
        
            );
        
        $donacion->monto = $request->monto;
        $donacion->fecha_donacion= $request->fecha_donacion;
        $donacion->id_donador= $request->id_donador;
        $donacion->id_receptor= $request->id_receptor;
        $donacion->id_metodo_pago= $request->id_metodo_pago;
        $donacion->id_playlist= $request->id_playlist;
        $donacion->id_video= $request->id_video;
        $donacion->save();

        return response()->json([
            "mesagge"=> "Se ha editado una donacion",
            $donacion
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
        //
        $donacion= Donation::find($id);

        if ($donacion==NULL) {
            return "No existe una donacion asociada al usuario ingresado";
        }

        $donacion->delete();
        return response()->json([
            "mesagge"=> "Se ha eliminado una donacion",
            $donacion
        ]);
    }
}
