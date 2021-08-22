<nav class="navbar navbar-light navbar-expand-md" id="barraNav">
    <div class="container-fluid">
        <img id="cheems1" src="{{asset('assets/img/cheems.png')}}" /><a
            class="navbar-brand"
            id="logo"
            href="{{ route('vistaIndice') }}"
            >CheemsTube</a
        ><button
            data-bs-toggle="collapse"
            class="navbar-toggler"
            data-bs-target="#navcol-1"
        >
            <span class="visually-hidden">Toggle navigation</span
            ><span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" id="itemBarra" href="#"
                        >Primera Sección</a
                    >
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link"
                        id="itemBarra"
                        href="#"
                        style="font-family: Alice, serif"
                        >Segunda Sección</a
                    >
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="itemBarra" href="{{route('vistaUsuarios')}}"
                        >Todos los usuarios</a
                    >
                </li>
            </ul>
            <div class="container text-end ms-auto" id="container1">
                <a
                    class="btn btn-primary d-block"
                    id="btnConectarse"
                    role="button"
                    style="background: rgba(13, 110, 253, 0)"
                    href="{{ route('vistaLogin') }}"
                >
                    Conectarse
                </a>
                
            </div>
        </div>
    </div>
</nav>
