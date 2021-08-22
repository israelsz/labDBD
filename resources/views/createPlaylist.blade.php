<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Agregar lista de reproduccion</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alice&amp;display=swap">
    <link rel="stylesheet" href="{{asset('assets/fonts/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
    
</head>
<body>
    <section>
        @auth
            @include('includes.navbarLogin')
            <section class="m-5 d-lg-flex d-xl-flex justify-content-lg-center align-items-lg-center justify-content-xl-center align-items-xl-center" style="filter: grayscale(0%) saturate(72%);border-style: none;border-top-style: none;border-bottom-width: 1px;">
                <div class="row" style="background: rgb(30,40,51);border-radius: 4px;transform-origin: center;">
                    <form  onsubmit="return handleData()" id ="formularioAgregarLista" method="post" action="{{route('agregarListaReproduccion',Auth::user()->id)}}" >
                        <h4 class="m-3" style="color: var(--bs-light)">Nombre de la lista de reproducción</h4>
                        <input name="nombre_playlist" class="form-control" type="text" style="color: var(--bs-light);background: rgba(255,255,255,0);border-radius: 0px;border-style: none;border-bottom-style: solid;border-bottom-color: rgb(67,74,82);weidgh;width: 230px;height: 27px;" placeholder="Ingrese nombre de la lista de reproduccion">
                        <h4 class="m-3" style="color: var(--bs-light)">Ingrese descripccion de la lista de reproduccion</h4>
                        <div class="form-floating mb-5">
                            <input name="descripcion_playlist" class="form-control" id="floatingTextarea" style="color: var(--bs-light);background: rgba(255,255,255,0);border-radius: 0px;border-style: none;border-bottom-style: solid;border-bottom-color: rgb(67,74,82);">
                        </div>
                        <h4 class="mb-3" style="color: var(--bs-light)">Seleccione los videos a agregar</h4>
                        <ul class="list-group">
                            @foreach ($videos as $video)
                            <li class="list-group-item">
                                <input type="checkbox" name="check_videos[]" value="{{$video->id}}"> <label>{{$video->titulo_video}}</label>
                            </li>
                            @endforeach
                        </ul>
                        <div class="d-flex flex-row-reverse bd-highlight mt-3 mb-3">
                            <a href='{{route('vistaListaReproduccion')}}' class="btn btn-secondary" type = "submit" style="margin-left: 20px">Cancelar</a>
                            <button class="btn btn-primary d-block w-10" type="submit">Crear lista de reproducción</button>
                        </div>
                    </form>
                </div>
            </section>
        @else
            @include('includes.navbarNoLogin')
        @endauth
    </section>
    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}">
</body>

</html>