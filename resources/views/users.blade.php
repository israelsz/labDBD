<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Indice</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('https://fonts.googleapis.com/css?family=Alice&amp;display=swap')}}">
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
    <div class="container mt-5">
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
                    <a class="btn btn-outline-warning" href="{{route('vistaUsuario',$user->id)}}" role = "button">Ver más información</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
        </table>
    </div>
    

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>