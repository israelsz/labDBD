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
            <form method="POST" action='{{route('editarVideo',$id)}}'>
                @method('PUT')
                <input
                  type="text"
                  name="titulo_video"
                  placeholder="Ingrese titulo video"
                  class="form-control mb-3"
                  style="color: var(--bs-light);background: rgba(255,255,255,0)"
                />
                <input
                  type="text"
                  name="direccion_video"
                  placeholder="Ingrese direccion de video"
                  class="form-control mb-3"
                  style= "color: var(--bs-light);background: rgba(255,255,255,0)"
                />
                <input
                  type="text"
                  name="visitas"
                  placeholder="Ingrese cantidad de visitas"
                  class="form-control mb-3"
                  style ="color: var(--bs-light);background: rgba(255,255,255,0)"
                />
                <input
                  type="text"
                  name="popularidad"
                  placeholder="Ingrese popularidad"
                  class="form-control mb-3"
                  style ="color: var(--bs-light);background: rgba(255,255,255,0)"
                />
                <input
                  type="text"
                  name="cantidad_temporadas"
                  placeholder="Ingrese cantidad temporadas"
                  class="form-control mb-3"
                  style ="color: var(--bs-light);background: rgba(255,255,255,0)"
                />
                <input
                  type="text"
                  name="descripcion"
                  placeholder="Ingrese descripcion"
                  class="form-control mb-3"
                  style ="color: var(--bs-light);background: rgba(255,255,255,0)"
                />
                <input
                  type="text"
                  name="restriccion_edad"
                  placeholder="Ingrese restriccion"
                  class="form-control mb-3"
                  style ="color: var(--bs-light);background: rgba(255,255,255,0)"
                />
  
                <h5 class="text-primary">Ingrese usuario autor</h1>

                    <select class="form-select" id="listaSelect" name="id_usuario_autor" style= "width: 230px;height: 40px;margin-top: 22px">
                        @foreach($usuarios as $usuario)
                        <option value="{{$usuario->id}}" selected="">{{$usuario->username}}</option>
                        @endforeach
                    </select>
                  
                  <h5 class="text-primary">Ingrese comuna:</h1>
    
                  <select class="form-select" id="listaSelect" name="id_comuna" style= "width: 230px;height: 40px;margin-top: 22px">
                      @foreach($comunas as $comuna)
                      <option value="{{$comuna->id}}" selected="">{{$comuna->nombre_comuna}}</option>
                      @endforeach
                  </select>
                
                <button class="btn btn-outline-success mt-2" type="submit">Agregar nuevo video</button>
                
              </form>
        </div>
    </div>

    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
</body>

</html>