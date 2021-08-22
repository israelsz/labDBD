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
            <form method="POST" action="{{route('editarTipoUsuario',$id)}}">
              @method('PUT')
              <input
              type="text"
              name="nombre_tipo_usuario"
              placeholder="Ingrese nombre del tipo de usuario"
              class="form-control mb-3"
              style="color: var(--bs-light);background: rgba(255,255,255,0)"
            />
            <input
              type="text"
              name="descripcion_tipo_usuario"
              placeholder="Ingrese descripcion del tipo de usuario"
              class="form-control mb-3"
              style= "color: var(--bs-light);background: rgba(255,255,255,0)"
            />
                <button class="btn btn-outline-success mt-2 col-2" type="submit">Actualizar Datos</button>
               
                <a class="btn btn-outline-light d-block col-2 mt-3" href={{route('vistaCrudAdmin')}} role = "button">Atras</a>
              </form>
        </div>
    </div>

    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
</body>

</html>