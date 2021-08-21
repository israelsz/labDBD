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
        @include('includes.navbarLogin')
    @else
        @include('includes.navbarNoLogin')
    @endauth
    
    @include('includes.mensajes')
    <div class="row">
        
    </div>
    <div class="container">
        <div class="container">
            <div class="row">
                @foreach($videosFiltrados as $vid)
                    <div class="col-4" style="padding-top: 5%;">
                        <div class="card">
                            <img
                                src="https://img.youtube.com/vi/{{substr($vid->direccion_video,-11)}}/0.jpg"
                                class="card-img-top"
                                alt="..."
                            />
                            <div class="card-body">
                                <h5 class="card-title">{{ $vid->titulo_video }}</h5>
                                <p class="card-text">{{$vid->descripcion}}</p>
                                <a href="{{route('vistaVideo', $vid)}}" class="btn btn-primary">Ver</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>