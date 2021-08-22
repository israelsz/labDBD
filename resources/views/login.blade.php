<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login</title>
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
            <h1 id="tituloLogin">Conectarse a una cuenta</h1>
        </div>

        <div class="container">
            <form id="formularioLogin" method="POST" action="{{route('intentarLogin')}}">
                <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
                <div class="mb-3"><input class="form-control" name="username" placeholder="Usuario"></div>
                <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Password"></div>
                <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Conectarse</button></div>
                <div class="container mt-3">
                    <h4 class="text-center" id="textoRegistro">¿No estas registrado?</h4>
                </div>
                <div class="mb-3" style="margin-top: -8px;"><a class="btn btn-primary d-block w-100" role="button" href="{{route('vistaRegister')}}">Registrarse</a></div>
            </form>
        </div>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>