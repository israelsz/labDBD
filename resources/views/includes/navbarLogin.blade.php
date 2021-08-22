<nav class="navbar navbar-light navbar-expand-md" id="barraNav">
    <div class="container-fluid"><img id="cheems1" src="{{asset('assets/img/cheems.png')}}">
        <a class="navbar-brand" id="logo" href="{{ route('vistaIndice') }}">CheemsTube</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" id="itemBarra" href="#">Primera Sección</a></li>
                <li class="nav-item"><a class="nav-link" id="itemBarra" href="#" style="font-family: Alice, serif;">Segunda Sección</a></li>
                <li class="nav-item"><a class="nav-link" id="itemBarra" href="{{route('vistaUsuarios')}}">Todos los usuarios</a></li>
            </ul>
            <ul class="navbar-nav text-center ms-auto px-5" id="nav2">
                <li class="nav-item"></li>
                <li class="nav-item"></li>
                <li class="nav-item"></li>
                <li class="nav-item"></li>
                <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" id="linkMiCuenta" href="#" style="color: rgb(255,255,255);">Mi cuenta</a>
                    <div class="dropdown-menu dropdown-menu-dark"><a class="dropdown-item" href="{{route('vistaUsuario',Auth::user()->id)}}">Mi cuenta</a>
                        <form style = "display: inline" action = "{{route('logout')}}" method="POST">
                            <a class="dropdown-item" href="#" onclick="this.closest('form').submit()">Desconectarse</a>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
