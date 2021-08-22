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
            <form method="POST" action="{{route('intentarRegisterCrud')}}">
                <input
                  type="text"
                  name="username"
                  placeholder="Nombre de usuario"
                  class="form-control mb-3"
                  style="color: var(--bs-light);background: rgba(255,255,255,0)"
                />
                <input
                  type="text"
                  name="password"
                  placeholder="Contraseña"
                  class="form-control mb-3"
                  style= "color: var(--bs-light);background: rgba(255,255,255,0)"
                />
                <input
                  type="text"
                  name="email"
                  placeholder="Correo electrónico"
                  class="form-control mb-3"
                  style ="color: var(--bs-light);background: rgba(255,255,255,0)"
                />
                
                <h5 class="text-primary">Ingrese comuna:</h1>

                <select class="form-select" id="listaSelect" name="id_comuna" style= "width: 230px;height: 40px;margin-top: 22px">
                    @foreach($comunas as $comuna)
                    <option value="{{$comuna->id}}" selected="">{{$comuna->nombre_comuna}}</option>
                    @endforeach
                </select>
                
                <h5 class="text-primary mt-3">Ingrese Fecha nacimiento:</h1>

                <div class="mt-3 mb-3"><input class="form-control" type="date" required="" name="fecha_nacimiento" style="background: rgba(255,255,255,0);color: var(--bs-light)"></div>

                <button class="btn btn-outline-success mt-2" type="submit">Agregar Nuevo Usuario</button>
                
              </form>
        </div>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                  <th scope="col">#Id</th>
                  <th scope="col">Username</th>
                  <th scope="col">Email</th>
                  <th scope="col">Opciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach($usuarios as $user)
                <tr>
                  <th scope="row">{{$user->id}}</th>
                  <td>{{$user->username}}</td>
                  <td>{{$user->email}}</td>
                  <td>
                    <form style = "display: inline" action = "{{route('vistaEditUsuarioCrud',$user)}}" method="GET">
                        <a class="btn btn-outline-warning" href="#" role = "button" onclick="this.closest('form').submit()">Modificar</a>
                    </form>

                    <form style = "display: inline" action = "{{route('eliminarUsuario',$user)}}" method="post">
                        @method('DELETE')
                        <button class="btn btn-outline-danger" type="submit">Eliminar</a>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
        </table>
    </div>

    <div class="container mt-5">
        <h1 class="text-primary">Crud Playlist:</h1>
        <div class="container p-4 mb-3 mt-2" style="background-color: rgb(30,40,51);">
            <form method="POST" action="{{route('CrearPlaylistCrud')}}">
                <input
                  type="text"
                  name="nombre_playlist"
                  placeholder="Nombre de playlist"
                  class="form-control mb-3"
                  style="color: var(--bs-light);background: rgba(255,255,255,0)"
                />
                <input
                  type="text"
                  name="descripcion_playlist"
                  placeholder="Descripcion"
                  class="form-control mb-3"
                  style= "color: var(--bs-light);background: rgba(255,255,255,0)"
                />

                <button class="btn btn-outline-success mt-2" type="submit">Agregar Nueva Playlist</button>

              </form>
        </div>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                  <th scope="col">#Id</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Descripcion</th>
                  <th scope="col">Opciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach($playlists as $playlist)
                <tr>
                  <th scope="row">{{$playlist->id}}</th>
                  <td>{{$playlist->nombre_playlist}}</td>
                  <td>{{$playlist->descripcion_playlist}}</td>
                  <td>
                    <form style = "display: inline" action = "{{route('vistaEditPlaylistCrud',$playlist)}}" method="GET">
                        <a class="btn btn-outline-warning" href="#" role = "button" onclick="this.closest('form').submit()">Modificar</a>
                    </form>

                    <form style = "display: inline" action = "{{route('EliminarPlaylist',$playlist)}}" method="post">
                        @method('DELETE')
                        <button class="btn btn-outline-danger" type="submit">Eliminar</a>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
        </table>
    </div>

    <div class="container mt-5">
        <h1 class="text-primary">Crud Feedback:</h1>
        <div class="container p-4 mb-3 mt-2" style="background-color: rgb(30,40,51);">
            <form method="POST" action="{{route('CrearFeedbackCrud')}}">
                <input
                  type="text"
                  name="tipo_valoracion"
                  placeholder="Tipo valoracion"
                  class="form-control mb-3"
                  style="color: var(--bs-light);background: rgba(255,255,255,0)"
                />
                <input
                  type="text"
                  name="id_usuario"
                  placeholder="ID Usuario"
                  class="form-control mb-3"
                  style= "color: var(--bs-light);background: rgba(255,255,255,0)"
                />
                <input
                  type="text"
                  name="id_video"
                  placeholder="ID Video"
                  class="form-control mb-3"
                  style= "color: var(--bs-light);background: rgba(255,255,255,0)"
                />

                <button class="btn btn-outline-success mt-2" type="submit">Agregar Nueva Valoracion</button>

              </form>
        </div>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                  <th scope="col">#Id</th>
                  <th scope="col">Tipo valoracion</th>
                  <th scope="col">ID Usuario</th>
                  <th scope="col">ID Video</th>
                  <th scope="col">Opciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach($feedbacks as $feedback)
                <tr>
                  <th scope="row">{{$feedback->id}}</th>
                  <td>{{$feedback->tipo_valoracion}}</td>
                  <td>{{$feedback->id_usuario}}</td>
                  <td>{{$feedback->id_video}}</td>
                  <td>
                    <form style = "display: inline" action = "{{route('vistaEditFeedbackCrud',$feedback)}}" method="GET">
                        <a class="btn btn-outline-warning" href="#" role = "button" onclick="this.closest('form').submit()">Modificar</a>
                    </form>

                    <form style = "display: inline" action = "{{route('EliminarFeedback',$feedback)}}" method="post">
                        @method('DELETE')
                        <button class="btn btn-outline-danger" type="submit">Eliminar</a>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
        </table>
    </div>

    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
</body>

</html>