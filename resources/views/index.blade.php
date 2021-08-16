<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Indice</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alice&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    
</head>

<body>
    @auth
        @include('includes.navbarLogin')
    @else
        @include('includes.navbarNoLogin')
    @endauth
    
    @include('includes.mensajes')

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>