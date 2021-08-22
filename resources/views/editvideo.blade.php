<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Indice</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alice&amp;display=swap">
    <link rel="stylesheet" href="{{asset('assets/fonts/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">

</head>

<body>
    @auth
    @include('includes.mensajes')
    @include('includes.navbarLogin')
    <div class="col-4 container mb-3" style="padding-top: 5%;">
        <div class="card">
            <img src="https://img.youtube.com/vi/{{substr($video->direccion_video,-11)}}/0.jpg" class="card-img-top" alt="..." />
            <div class="card-body">
                <h5 class="card-title">{{ $video->titulo_video }}</h5>
                <p class="card-text">{{ $video->descripcion}}</p>
            </div>
        </div>
    </div>


    <div class="container" style="background-color: #1e2833;">
        <div class="container p-3">
            <form action="{{ route('updateVideo', $video->id) }}" method="POST">
                @method('PUT')
                <input class="form-control mb-2 mt-2" type="text" placeholder="titulo" name="titulo_video" id="titulo_video" value="" required minlength="3">
                <input class="form-control mb-2" type="text" placeholder="descripcion" name="descripcion" id="descripcion" value="" required minlength="3">
                <input class="form-control mb-2" type="text" placeholder="https://www.youtube.com/embed/" name="direccion_video" id="direccion_video" value="" pattern="https?://www.+youtube.com/embed/+.*" required maxlength="41">
                <button class="btn btn-warning btn-block" type="submit">Editar</button>
            </form>

        </div>

    </div>
    @else
    {{route('vistaRegister')}}
    @endauth


    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
</body>

</html>