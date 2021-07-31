<?php

namespace App\Observers;

use App\Models\Donation;
use App\Models\User;

class DonationObserver
{
    
    //Trigger de donacion, al crearse una donacion se encarga de sumar y restar el dinero adecuado en la base de datos
    public function created(Donation $donation)
    {
        //Se resta el dinero a la persona que realizo la donacion
        $usuarioDonador = User::find($donation->id_donador);
        $usuarioDonador->monedero = $usuarioDonador->monedero - $donation->monto;

        //Se suma el dinero a la persona que recibio la donacion
        $usuarioRecibeDonacion = User::find($donation->id_receptor);
        $usuarioRecibeDonacion->monedero = $usuarioRecibeDonacion->monedero + $donation->monto;

        $usuarioDonador->save();
        $usuarioRecibeDonacion->save();
    }

    /**
     * Handle the Donation "updated" event.
     *
     * @param  \App\Models\Donation  $donation
     * @return void
     */
    public function updated(Donation $donation)
    {
        //
    }

    /**
     * Handle the Donation "deleted" event.
     *
     * @param  \App\Models\Donation  $donation
     * @return void
     */
    public function deleted(Donation $donation)
    {
        //
    }

    /**
     * Handle the Donation "restored" event.
     *
     * @param  \App\Models\Donation  $donation
     * @return void
     */
    public function restored(Donation $donation)
    {
        //
    }

    /**
     * Handle the Donation "force deleted" event.
     *
     * @param  \App\Models\Donation  $donation
     * @return void
     */
    public function forceDeleted(Donation $donation)
    {
        //
    }
}
