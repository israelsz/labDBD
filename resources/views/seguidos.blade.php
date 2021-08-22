<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Canales que sigues</title>
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
        <h1 class="text-primary">Seguidos por ti:</h1>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                  <th scope="col">#Id</th>
                  <th scope="col">Username</th>
                  <th scope="col">Email</th>
                </tr>
              </thead>
              <tbody>
                @foreach($arrayUsernames as $seguido)
                    <tr>
                        <th scope="row">{{$seguido->id}}</th>
                        <td>{{$seguido->username}}</td>
                        <td>{{$seguido->email}}</td>
                    </tr>
                @endforeach
              </tbody>
        </table>
    </div>
    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
</body>

</html>