<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Register</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alice&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <section class="login-dark">
        @auth
            @if(Auth::user()->id_tipo_usuario == 3)
                @include('includes.navbarAdmin')
            @else
                @include('includes.navbarLogin')
             @endif
        @else
            @include('includes.navbarNoLogin')
        @endauth
    
        @include('includes.mensajes')

        <div class="container mt-2">
            <h1 id="tituloLogin">Registrarse</h1>
        </div>

        <form id="formularioLogin" method="post" action="{{route('intentarRegister')}}">
            <div class="illustration"><img id="imagenRegister1" src="assets/img/newuser2.png"></div>
            <div class="mb-3"><input class="form-control" name="username" placeholder="Usuario" required=""></div>
            <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Password" required=""></div>
            <div class="mb-3"><input class="form-control" type="email" name="email" placeholder="Email" required=""></div>
            <div class="mt-3 mb-3">
                <h5 class="text-primary" id="textoComuna">Selecciona tu comuna</h5>
            </div>
            <div class="mt-3 mb-3">
                <select class="form-select" id="listaSelect" name="id_comuna" required="">
                    @foreach($comunas as $comuna)
                    <option value="{{$comuna->id}}" selected="">{{$comuna->nombre_comuna}}</option>
                    @endforeach
                </select></div>
            <div class="mt-3 mb-3"><input class="form-control" type="date" required="" name="fecha_nacimiento"></div>
            <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Registrarse</button></div>
        </form>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>