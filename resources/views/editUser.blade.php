<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
</head>

<body >
    <div>
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
    </div>
    <section class="d-lg-flex d-xl-flex justify-content-lg-center align-items-lg-center justify-content-xl-center align-items-xl-center" style="background: rgb(21,32,43);filter: grayscale(0%) saturate(72%);border-style: none;border-top-style: none;border-bottom-width: 1px;">
        <div class="col-6" style="background: rgb(30,40,51);border-radius: 4px;transform-origin: center;">
            <h1 style="color: var(--bs-light);margin: 16px;">Editar información de usuario {{$usuario->username}}</h1>
            <form action='{{route('intentarEditarUsuario',$usuario)}}' style="margin: 18px;", method="POST">
                @method('PUT')   
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <section>
                                <div class="d-xl-flex justify-content-xl-start align-items-xl-end row-cols-1"><label class="form-label" style="font-size: 14px;color: var(--bs-light);margin-top: 12px;margin-bottom: -4px;">Nombre de usuario</label></div>
                                <div><label class="form-label" style="color: var(--bs-light);">{{$usuario->username}}</label></div>
                            </section>
                            <section>
                                <div class="d-xl-flex justify-content-xl-start align-items-xl-end row-cols-1"><label class="form-label" style="font-size: 14px;color: var(--bs-light);margin-top: 12px;margin-bottom: -4px;">Correo electronico</label></div>
                                <div><label class="form-label" style="color: var(--bs-light);">{{$usuario->email}} </label></div>
                            </section>
                            <section>
                                <div class="d-xl-flex justify-content-xl-start align-items-xl-end row-cols-1"><label class="form-label" style="font-size: 14px;color: var(--bs-light);margin-top: 12px;margin-bottom: -4px;">Contraseña</label></div>
                                <div><label class="form-label" style="color: var(--bs-light);">**********</label></div>
                            </section>
                            <section>
                                <div class="d-xl-flex justify-content-xl-start align-items-xl-end row-cols-1"><label class="form-label" style="font-size: 14px;color: var(--bs-light);margin-top: 12px;margin-bottom: -4px;">Comuna</label></div>
                                <div><label class="form-label" style="color: var(--bs-light);">{{$comuna_usuario->nombre_comuna}}</label></div>
                            </section>
                        </div>
                        <div class="col-md-6">
                            <section>
                                <input class="form-control" id="username" name="username"  type="text" style="margin-top: 22px;width: 230px;height: 27px;color: var(--bs-light);background: rgba(255,255,255,0);border-radius: 0px;border-style: none;border-bottom-style: solid;border-bottom-color: rgb(67,74,82);" placeholder="Ingrese nombre de usuario">
                                <input class="form-control" id="email" name="email" type="email" style="margin-top: 35px;width: 230px;height: 27px;color: var(--bs-light);background: rgba(255,255,255,0);border-radius: 0px;border-style: none;border-bottom-style: solid;border-bottom-color: rgb(67,74,82);" placeholder="Ingrese correo electronico" >
                                <input class="form-control" id="password" name="password" type="password" style="margin-top: 35px;width: 230px;height: 27px;color: var(--bs-light);background: rgba(255,255,255,0);border-radius: 0px;border-style: none;border-bottom-style: solid;border-bottom-color: rgb(67,74,82);" placeholder="Ingrese contraseña"></section>
                            <div class="mt-3 mb-3">
                                <select class="form-select" id="listaSelect" name="id_comuna" style= "width: 230px;height: 40px;margin-top: 22px">
                                    @foreach($comunas as $comuna)
                                    <option value="{{$comuna->id}}" selected="">{{$comuna->nombre_comuna}}</option>
                                    @endforeach
                                </select></div>
                        </div>
                    </div>
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <a href='{{route('vistaUsuario',$usuario)}}' class="btn btn-secondary" type = "submit" style="margin-left: 20px">Cancelar</a>
                        <button href= '/' class="btn btn-primary d-block w-10" type="submit">Confirmar cambios</button>
                    </div>
                </div>
                
            </form>
        </div>
    </section>
    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
</body>
</html>