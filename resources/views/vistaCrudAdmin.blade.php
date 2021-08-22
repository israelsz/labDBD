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
        <h1 class="text-primary">Crud Pais:</h1>
        <div class="container p-4 mb-3 mt-2" style="background-color: rgb(30,40,51);">
            <form method="POST" action="{{route('RegisterCrudPais')}}">
                @method('PUT')
                <input
                  type="text"
                  name="nombre_pais"
                  placeholder="Nombre de pais"
                  class="form-control mb-3"
                  style="color: var(--bs-light);background: rgba(255,255,255,0)"
                />
        
                <button class="btn btn-outline-success mt-2" type="submit">Agregar Nuevo País</button>
                
              </form>
        </div>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                  <th scope="col">#Id</th>
                  <th scope="col">Nombre Pais</th>
                </tr>
              </thead>
              <tbody>
                @foreach($paises as $pais)
                <tr>
                  <th scope="row">{{$pais->id}}</th>
                  <td>{{$pais->nombre_pais}}</td>
                  <td>
                    <form style = "display: inline" action = "{{route('vistaEditPaisCrud',$pais)}}" method="GET">
                        <a class="btn btn-outline-warning" href="#" role = "button" onclick="this.closest('form').submit()">Modificar</a>
                    </form>

                    <form style = "display: inline" action = "{{route('eliminarPais',$pais)}}" method="post">
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
        <h1 class="text-primary">Crud Region:</h1>
        <div class="container p-4 mb-3 mt-2" style="background-color: rgb(30,40,51);">
            <form method="POST" action="{{route('storeRegion')}}">
                <input
                  type="text"
                  name="nombre_region"
                  placeholder="Nombre de región"
                  class="form-control mb-3"
                  style="color: var(--bs-light);background: rgba(255,255,255,0)"
                />
                
                <select class="form-select" id="listaSelect" name="id_pais" style= "width: 230px;height: 40px;margin-top: 22px">
                    @foreach($paises as $pais)
                    <option value="{{$pais->id}}" selected="">{{$pais->nombre_pais}}</option>
                    @endforeach
                </select>

                <button class="btn btn-outline-success mt-2" type="submit">Agregar Nueva Región</button>
                
              </form>
        </div>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                  <th scope="col">#Id</th>
                  <th scope="col">Nombre Región</th>
                </tr>
              </thead>
              <tbody>
                @foreach($regiones as $region)
                <tr>
                  <th scope="row">{{$region->id}}</th>
                  <td>{{$region->nombre_region}}</td>
                  <td>
                    <form style = "display: inline" action = "{{route('vistaEditRegionCrud',$region)}}" method="GET">
                        <a class="btn btn-outline-warning" href="#" role = "button" onclick="this.closest('form').submit()">Modificar</a>
                    </form>

                    <form style = "display: inline" action = "{{route('eliminarRegion',$region)}}" method="post">
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
        <h1 class="text-primary">Crud Comunas:</h1>
        <div class="container p-4 mb-3 mt-2" style="background-color: rgb(30,40,51);">
            <form method="POST" action="{{route('storeComuna')}}">
                <input
                  type="text"
                  name="nombre_comuna"
                  placeholder="Nombre de comuna"
                  class="form-control mb-3"
                  style="color: var(--bs-light);background: rgba(255,255,255,0)"
                />
                
                <select class="form-select" id="listaSelect" name="id_region" style= "width: 230px;height: 40px;margin-top: 22px">
                    @foreach($regiones as $region)
                    <option value="{{$region->id}}" selected="">{{$region->nombre_region}}</option>
                    @endforeach
                </select>

                <button class="btn btn-outline-success mt-2" type="submit">Agregar Nueva Comuna</button>
                
              </form>
        </div>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                  <th scope="col">#Id</th>
                  <th scope="col">Nombre Comunas</th>
                </tr>
              </thead>
              <tbody>
                @foreach($comunas as $comuna)
                <tr>
                  <th scope="row">{{$comuna->id}}</th>
                  <td>{{$comuna->nombre_comuna}}</td>
                  <td>
                    <form style = "display: inline" action = "{{route('vistaEditComunaCrud',$comuna)}}" method="GET">
                        <a class="btn btn-outline-warning" href="#" role = "button" onclick="this.closest('form').submit()">Modificar</a>
                    </form>

                    <form style = "display: inline" action = "{{route('eliminarComuna',$comuna)}}" method="post">
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
        <h1 class="text-primary">Crud Comentarios:</h1>
        <div class="container p-4 mb-3 mt-2" style="background-color: rgb(30,40,51);">
            <form method="POST" action="{{route('storeComentario')}}">
                <input
                  type="text"
                  name="contenido"
                  placeholder="Comentario"
                  class="form-control mb-3"
                  style="color: var(--bs-light);background: rgba(255,255,255,0)"
                />
                
                <select class="form-select" id="listaSelect" name="id_usuario" style= "width: 230px;height: 40px;margin-top: 22px">
                    @foreach($usuarios as $usuario)
                    <option value="{{$usuario->id}}" selected="">{{$usuario->username}}</option>
                    @endforeach
                </select>

                <select class="form-select" id="listaSelect" name="id_video" style= "width: 230px;height: 40px;margin-top: 22px">
                    @foreach($videos as $video)
                    <option value="{{$video->id}}" selected="">{{$video->titulo_video}}</option>
                    @endforeach
                </select>

                <button class="btn btn-outline-success mt-2" type="submit">Agregar Nuevo Comentario</button>
                
              </form>
        </div>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                  <th scope="col">#Id</th>
                  <th scope="col">Nombre Comunas</th>
                </tr>
              </thead>
              <tbody>
                @foreach($comentarios as $comentario)
                <tr>
                  <th scope="row">{{$comentario->id}}</th>
                  <td>{{$comentario->contenido}}</td>
                  <td>
                    <form style = "display: inline" action = "{{route('vistaEditComentarioCrud',$comentario)}}" method="GET">
                        <a class="btn btn-outline-warning" href="#" role = "button" onclick="this.closest('form').submit()">Modificar</a>
                    </form>

                    <form style = "display: inline" action = "{{route('eliminarComentario',$comentario)}}" method="post">
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

    <div class="container mt-5">
      <h1 class="text-primary">Crud Videos:</h1>
      <div class="container p-4 mb-3 mt-2" style="background-color: rgb(30,40,51);">
          <form method="POST" action='{{route('crearVideo')}}'>
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
      <table class="table table-dark table-striped">
          <thead>
              <tr>
                <th scope="col">#Id</th>
                <th scope="col">Titulo</th>
                <th scope="col">Visitas</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Autor</th>
                <th scope="col">Restriccion</th>
                <th scope="col">Popularidad</th>
                <th scope="col">Cantidad Temporadas</th>
                <th scope="col">Id comna</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($videos as $video)
              <tr>
                <th scope="row">{{$video->id}}</th>
                <td>{{$video->titulo_video}}</td>
                <td>{{$video->visitas}}</td>
                <td>{{$video->descripcion}}</td>
                <td>{{$video->id_usuario_autor}}</td>
                <td>{{$video->restriccion_edad}}</td>
                <td>{{$video->popularidad}}</td>
                <td>{{$video->cantidad_temporadas}}</td>
                <td>{{$video->id_comuna}}</td>
                <td>
                  <form style = "display: inline" action = '{{route('vistaEditarVideo',$video->id)}}' method="GET">
                      <a class="btn btn-outline-warning" href="#" role = "button" onclick="this.closest('form').submit()">Modificar</a>
                  </form>
                  <form style = "display: inline" action = {{route('eliminarVideo',$video->id)}} method="post">
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
    <h1 class="text-primary">Crud Tipo de usuario:</h1>
    <div class="container p-4 mb-3 mt-2" style="background-color: rgb(30,40,51);">
        <form method="POST" action="{{route('crearTipoUsuario')}}">
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

            <button class="btn btn-outline-success mt-2" type="submit">Agregar Nuevo tipo de usuario</button>
            
          </form>
    </div>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
              <th scope="col">#Id</th>
              <th scope="col">Nombre Tipo Usuario</th>
              <th scope="col">Descripción</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($usuarioTipos as $usuarioTipo)
            <tr>
              <th scope="row">{{$usuarioTipo->id}}</th>
              <td>{{$usuarioTipo->nombre_tipo_usuario}}</td>
              <td>{{$usuarioTipo->descripcion_tipo_usuario}}</td>
              <td>
                <form style = "display: inline" action = {{route('viewEditarTipoUsuario',$usuarioTipo->id)}} method="GET">
                    <a class="btn btn-outline-warning" href="#" role = "button" onclick="this.closest('form').submit()">Modificar</a>
                </form>

                <form style = "display: inline" action = {{route('eliminarTipousuario',$usuarioTipo->id)}} method="post">
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
    <h1 class="text-primary">Crud Donaciones:</h1>
    <div class="container p-4 mb-3 mt-2" style="background-color: rgb(30,40,51);">
        <form method="POST" action="{{route('crearDonacion')}}">
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


            <button class="btn btn-outline-success mt-2" type="submit">Agregar nueva donación</button>
            
          </form>
    </div>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
              <th scope="col">#Id</th>
              <th scope="col">id_donador</th>
              <th scope="col">id_receptor</th>
              <th scope="col">id_metodo_pago</th>
              <th scope="col">id_playlist</th>
              <th scope="col">id_video</th>
              <th scope="col">fecha_donacion</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($donaciones as $donacion)
            <tr>
              <th scope="row">{{$donacion->id}}</th>
              <td>{{$donacion->id_donador}}</td>
              <td>{{$donacion->id_receptor}}</td>
              <td>{{$donacion->id_metodo_pago}}</td>
              <td>{{$donacion->id_playlist}}</td>
              <td>{{$donacion->id_video}}</td>
              <td>{{$donacion->fecha_donacion}}</td>
              <td>
                <form style = "display: inline" action = '{{route('vistaEditarDonacion',$donacion->id)}}'  method="GET">
                    <a class="btn btn-outline-warning" href="#" role = "button" onclick="this.closest('form').submit()">Modificar</a>
                </form>

                <form style = "display: inline" action = '{{route('eliminarDonacion',$donacion->id)}}' method="post">
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
        <h1 class="text-primary">Crud Metodos de pago:</h1>
        <div class="container p-4 mb-3 mt-2" style="background-color: rgb(30,40,51);">
            <form method="POST" action="{{route('CrearMetodoPago')}}">
                <input
                  type="text"
                  name="nombre_metodo_pago"
                  placeholder="Nombre de usuario"
                  class="form-control mb-3"
                  style="color: var(--bs-light);background: rgba(255,255,255,0)"
                />
                <button class="btn btn-outline-success mt-2" type="submit">Agregar Metodo Pago</button>
                
              </form>
        </div>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                  <th scope="col">#Id</th>
                  <th scope="col">Nombre metodo de pago</th>
                </tr>
              </thead>
              <tbody>
              @foreach($metodosPago as $metodo)
                <tr>
                  <th scope="row">{{$metodo->id}}</th>
                  <td>{{$metodo->nombre_metodo_pago}}</td>
                  <td>
                    <form style = "display: inline" action = "{{route('vistaEditMetodosCrud',$metodo)}}" method="GET">
                        <a class="btn btn-outline-warning" href="#" role = "button" onclick="this.closest('form').submit()">Modificar</a>
                    </form>

                    <form style = "display: inline" action = "{{route('eliminarMetodo',$metodo->id)}}" method="post">
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
        <h1 class="text-primary">Crud Categoria:</h1>
        <div class="container p-4 mb-3 mt-2" style="background-color: rgb(30,40,51);">
            <form method="POST" action="{{route('crearCategoria')}}">
                <input
                  type="text"
                  name="nombre_categoria"
                  placeholder="Nombre de usuario"
                  class="form-control mb-3"
                  style="color: var(--bs-light);background: rgba(255,255,255,0)"
                />
                <button class="btn btn-outline-success mt-2" type="submit">Agregar Categoria</button>
                
              </form>
        </div>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                  <th scope="col">#Id</th>
                  <th scope="col">Nombre categoria</th>
                </tr>
              </thead>
              <tbody>
              @foreach($categorias as $categoria)
                <tr>
                  <th scope="row">{{$categoria->id}}</th>
                  <td>{{$categoria->nombre_categoria}}</td>
                  <td>
                    <form style = "display: inline" action = "{{route('vistaEditCategoriaCrud',$categoria)}}" method="GET">
                        <a class="btn btn-outline-warning" href="#" role = "button" onclick="this.closest('form').submit()">Modificar</a>
                    </form>

                    <form style = "display: inline" action = "{{route('eliminarCategoria',$categoria->id)}}" method="post">
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