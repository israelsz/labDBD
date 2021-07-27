<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Se traen todos los metodo de pago de la base de datos
        $metodoPago = PaymentMethod::all();

        //Se verifica en caso este vacia
        if($metodoPago == NULL){
            return "No existen metodo de pago";
        }
        return response()->json($metodoPago);
    }

    public function store(Request $request)
    {
        $metodoPago = new PaymentMethod();
        $request->validate([
            'nombre_metodo_pago' => 'required|max:200'
        ],[ //Mensajes de error abajo
            'nombre_metodo_pago.required' => 'Debe ingresar el nombre del metodo de pago'
        ]);

        $metodoPago->nombre_metodo_pago = $request->nombre_metodo_pago;
        $metodoPago->save();
        return response()->json([
            "message" => "Se ha creado un nuevo metodo de pago",
            $metodoPago
        ]);
    }

    public function show($id)
    {
        $metodoPago = PaymentMethod::find($id);
        
        if($metodoPago == NULL){
            return "No existe un metodo de pago asociado a ese id";
        }

        return response()->json($metodoPago);
    }
    public function update(Request $request, $id)
    {
        $metodoPago = PaymentMethod::find($id);
        if($metodoPago == NULL){
            return "No existe un metodo de pago asociada a ese id";
        }
        $request->validate([
            'nombre_metodo_pago' => 'required|max:200'
        ],[ //Mensajes de error abajo
            'nombre_metodo_pago.required' => 'Debe ingresar el nombre del metodo de pago'

        ]);

        $metodoPago->nombre_metodo_pago = $request->nombre_metodo_pago;
        $metodoPago->save();
        return response()->json($metodoPago);
    }

    public function destroy($id)
    {
        $metodoPago = PaymentMethod::find($id);
        
        if($metodoPago == NULL){
            return "No existe un metodo de pago asociado a ese id";
        }
        $metodoPago->delete();
        return response()->json([
            "message" => "Se ha borrado el metodo de pago",
            "id" => $metodoPago->id
        ]);
    }
}
