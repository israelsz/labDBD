<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Donar</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('https://fonts.googleapis.com/css?family=Alice&amp;display=swap')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
    
</head>

<body>
    @auth 
        @include('includes.navbarLogin')
        @include('includes.mensajes')
        
        <section class="login-dark mt-5" style ="height: auto; width: 500px;">
            <form id="formularioLogin" method="post" action="{{route('donacionConMonedero',$usuarioRecibe)}}">
                <h3 class ="mb-3">Donar con monedero</h3>
                <h5 class ="mb-3">Tienes: {{Auth::user()->monedero}} bolivares</h3>
                <div class="mb-3"><input class="form-control" name="monto_monedero" placeholder="Monto a donar" required=""></div>
                
                <div class="mt-3 mb-3"><button class="btn btn-primary d-block w-100" type="submit">Efectuar donacion</button></div>
                <div class="mt-3 mb-3"><a class="btn btn-secondary d-block w-100" href="{{route('vistaUsuario',$usuarioRecibe)}}" role="button">Cancelar</a></div>
            </form>
        </section>

        <section class="login-dark" style="height: auto; width: auto;">
            <form id="formularioLogin" method="post" action="{{route('donacionConTarjeta',$usuarioRecibe)}}">
                <h3 class ="mb-3">Donar con tarjetas</h3>
                <div class="mb-3"><input class="form-control" name="monto_tarjeta" placeholder="Monto a donar" required=""></div>
                <div class="mt-3 mb-3">
                    <h4 class ="mt-2">Elige tu metodo de pago</h4>
                </div>
                <div class="mt-3 mb-3">
                    <select class="form-select" id="listaSelect" name="id_metodo_pago_tarjeta" required="">
                        @foreach($metodosPago as $metodoPago)
                        <option value="{{$metodoPago->id}}" selected="">{{$metodoPago->nombre_metodo_pago}}</option>
                        @endforeach
                    </select></div>
                <div class="mt-3 mb-3"><button class="btn btn-primary d-block w-100" type="submit">Recargar Saldo</button></div>
                <div class="mt-3 mb-3"><a class="btn btn-secondary d-block w-100" href="{{route('vistaUsuario',$usuarioRecibe)}}" role="button">Cancelar</a></div>
            </form>
    </section>
        

    @else
        <!-- Fuera de aqui, usuario no autenticado -->
    @endauth

    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
</body>

</html>