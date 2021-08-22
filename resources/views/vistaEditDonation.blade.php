<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Admin Crud</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('https://fonts.googleapis.com/css?family=Alice&amp;display=swap')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
    
</head>

<body>
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

    <div class="container mt-5">
        <h1 class="text-primary">Crud Usuarios:</h1>
        <div class="container p-4 mb-3 mt-2" style="background-color: rgb(30,40,51);">
            <form method="POST" action="{{route('editarDonacion',$id)}}">
              @method('PUT')
              <input
              type="text"
              name="monto"
              placeholder="Ingrese monto"
              class="form-control mb-3"
              style="color: var(--bs-light);background: rgba(255,255,255,0)"
            />

            <select class="form-select" id="listaSelect" name="id_donador" style= "width: 230px;height: 40px;margin-top: 22px">
              @foreach($usuarios as $usuario)
                <option value="{{$usuario->id}}" selected="">{{$usuario->username}}</option>
              @endforeach
            </select>

            <select class="form-select" id="listaSelect" name="id_receptor" style= "width: 230px;height: 40px;margin-top: 22px">
              @foreach($usuarios as $usuario)
                <option value="{{$usuario->id}}" selected="">{{$usuario->username}}</option>
              @endforeach
            </select>

            <select class="form-select" id="listaSelect" name="id_metodo_pago" style= "width: 230px;height: 40px;margin-top: 22px">
              @foreach($metodosPago as $metodo)
                <option value="{{$metodo->id}}" selected="">{{$metodo->nombre_metodo_pago}}</option>
              @endforeach
            </select>

            <select class="form-select" id="listaSelect" name="id_playlist" style= "width: 230px;height: 40px;margin-top: 22px">
              @foreach($playlists as $lista)
                <option value="{{$lista->id}}" selected="">{{$lista->nombre_playlist}}</option>
              @endforeach
            </select>

            <select class="form-select" id="listaSelect" name="id_video" style= "width: 230px;height: 40px;margin-top: 22px">
              @foreach($videos as $video)
                <option value="{{$video->id}}" selected="">{{$video->titulo_video}}</option>
              @endforeach
            </select>
            <h5 class="text-primary mt-3">Ingrese Fecha de donación:</h1>

            <div class="mt-3 mb-3"><input class="form-control" type="date" required="" name="fecha_donacion" style="background: rgba(255,255,255,0);color: var(--bs-light)"></div>
              
                <button class="btn btn-outline-success mt-2 col-2" type="submit">Actualizar Datos</button>
               
                <a class="btn btn-outline-light d-block col-2 mt-3" href={{route('vistaCrudAdmin')}} role = "button">Atras</a>

              </form>
        </div>
    </div>

    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
</body>

</html>