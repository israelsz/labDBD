<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>diseñoDBD</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alice&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    
</head>

<body>
    <section class="login-dark">

         @include('includes.navbarNoLogin')

        <div class="container mt-2">
            <h1 id="tituloLogin">Conectarse a una cuenta</h1>
        </div>
        <form id="formularioLogin" method="post">
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="mb-3"><input class="form-control" type="email" name="username" placeholder="Usuario"></div>
            <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Password"></div>
            <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Conectarse</button></div>
            <div class="container mt-3">
                <h4 class="text-center" id="textoRegistro">¿No estas registrado ?</h4>
            </div>
            <div class="mb-3" style="margin-top: -8px;"><a class="btn btn-primary d-block w-100" role="button" href="#">Registrarse</a></div>
        </form>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>