<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Usuario</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('https://fonts.googleapis.com/css?family=Alice&amp;display=swap')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
    
</head>

<body>
    @auth
        @include('includes.navbarLogin')
        @if (Auth::user()->id==$user->id)
            @include('includes.mensajes')
            <div class="col-4 mx-auto" style="background: rgb(30,40,51);border-radius: 4px;transform-origin: center;padding: 20px; margin-top: 40px" just>
                <h1 style="color: var(--bs-light); ">Información de usuario</h1>
                <h4 style="color: var(--bs-light)">Nombre de usuario</h4>
                <h6  class="mb-3" style="color: var(--bs-light); ">{{$user->username}}</h6>
                <h4 style="color: var(--bs-light)">Correo Electronico</h4>
                <h6 class="mb-3"  style="color: var(--bs-light);">{{$user->email}}</h6>
                <h4 style="color: var(--bs-light)">Saldo en el monedero</h4>
                <h6 class="mb-3"  style="color: var(--bs-light);">{{$user->monedero}}</h6>
                <h4 style="color: var(--bs-light)">Fecha de nacimientp</h4>
                <h6 class="mb-3"  style="color: var(--bs-light);">{{$user->fecha_nacimiento}}</h6>
                <h4 style="color: var(--bs-light)">Comuna</h4>
                <h6 class="mb-3"  style="color: var(--bs-light);">{{$comuna->nombre_comuna}}</h6>
                <div class="d-flex flex-row-reverse bd-highlight mt-4">
                    <a href='/' class="btn btn-secondary" type = "submit" style="margin-left: 20px">Cancelar</a>
                    <a href= '{{route('vistaEditarUsuario',$user)}}' class="btn btn-primary d-block w-10 me-3" type="submit">Editar Usuario</a>
                    <a href= '{{route('vistaRecargarSaldo',$user)}}' class="btn btn-outline-warning me-3" type="submit">Recargar Saldo</a>
                </div>
            </div>
        @else
            <div class="col-4 mx-auto" style="background: rgb(30,40,51);border-radius: 4px;transform-origin: center;padding: 20px; margin-top: 40px" just>
                <h1 style="color: var(--bs-light); ">Información de usuario</h1>
                <h4 style="color: var(--bs-light)">Nombre de usuario</h4>
                <h6  class="mb-3" style="color: var(--bs-light); ">{{$user->username}}</h6>
                <h4 style="color: var(--bs-light)">Correo Electronico</h4>
                <h6 class="mb-3"  style="color: var(--bs-light);">{{$user->email}}</h6>
                <h4 style="color: var(--bs-light)">Saldo en el monedero</h4>
                <h6 class="mb-3"  style="color: var(--bs-light);">{{$user->monedero}}</h6>
                <h4 style="color: var(--bs-light)">Fecha de nacimiento</h4>
                <h6 class="mb-3"  style="color: var(--bs-light);">{{$user->fecha_nacimiento}}</h6>
                <h4 style="color: var(--bs-light)">Comuna</h4>
                <h6 class="mb-3"  style="color: var(--bs-light);">{{$comuna->nombre_comuna}}</h6>
                <div class="d-flex flex-row-reverse bd-highlight">
                    <a href='/' class="btn btn-secondary" type = "submit" style="margin-left: 20px">Cancelar</a>
                    <a href= '{{route('vistaDonar',$user)}}' class="btn btn-outline-info me-3" type="submit">Donar</a>
                </div>
            </div>
            
        @endif
    @else
        @include('includes.navbarNoLogin')
        <div class="col-4 mx-auto" style="background: rgb(30,40,51);border-radius: 4px;transform-origin: center;padding: 20px; margin-top: 40px" just>
            <h1 style="color: var(--bs-light); ">Información de usuario</h1>
            <h4 style="color: var(--bs-light)">Nombre de usuario</h4>
            <h6  class="mb-3" style="color: var(--bs-light); ">{{$user->username}}</h6>
            <h4 style="color: var(--bs-light)">Correo Electronico</h4>
            <h6 class="mb-3"  style="color: var(--bs-light);">{{$user->email}}</h6>
            <h4 style="color: var(--bs-light)">Saldo en el monedero</h4>
            <h6 class="mb-3"  style="color: var(--bs-light);">{{$user->monedero}}</h6>
            <h4 style="color: var(--bs-light)">Fecha de nacimiento</h4>
            <h6 class="mb-3"  style="color: var(--bs-light);">{{$user->fecha_nacimiento}}</h6>
            <h4 style="color: var(--bs-light)">Comuna</h4>
            <h6 class="mb-3"  style="color: var(--bs-light);">{{$comuna->nombre_comuna}}</h6>
            <div class="d-flex flex-row-reverse bd-highlight">
                <a href='/' class="btn btn-secondary" type = "submit" style="margin-left: 20px">Cancelar</a>
            </div>
        </div>
    @endauth
    
    
    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
</body>

</html>