<!DOCTYPE html>
<html lang="es" style="transform: translate(0px);">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Visualizacion</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
</head>

<body id="body">    
    @auth
        @include('includes.navbarLogin')
        @include('includes.mensajes')
    <div id="mainDiv" class="in-flex">
        <div id="tituloVideoDiv" class="row in-flex">
            <h1 id="tituloVideo" class="col-10">{{$videoSeleccionado->titulo_video}}</h1>
            <p id="reproduccionesYFecha" class="row col-5">{{$videoSeleccionado->visitas}} reproducciones</p>
        </div>
        <div class="float-none in-flex container" id="contenidoVideo">
            <div class="d-inline-flex flex-grow-0 flex-shrink-0 ratio ratio-16x9 container videoDiv" id="videoDiv">
                @if ($edad >= 18 || $videoSeleccionado->restriccion_edad==0)
                    <iframe id="videoIframe" src="{{$videoSeleccionado->direccion_video}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                @else
                    <div class="d-inline-flex flex-grow-0 flex-shrink-0 ratio ratio-16x9 container videoDiv" id="videoDiv" style="border: 4px solid rgb(255,255,255);">
                        <h3 id = "registrateHeading">Este video tiene restricción de edad</h3></div>
                @endif
        </div>   
            <div id="infoVideoDiv" class="in-flex container">
                <div class="container" id="infoVideoContainer">
                    <div class="row" id="rowAutor">
                        <div class="col" style="border-bottom: 4px solid var(--bs-white) ;">
                            <form id="formSuscripcion" method="POST" action="{{route('HacerSuscripcion', ['id_suscriptor' => Auth::user()->id, 'id_suscripcion' => $autorVideo->id])}}">
                                <h4 id="autorVideo">por: {{$autorVideo->username}}
                                    @if ($estaSuscrito == 0)
                                        <button class="btn btn-primary" id="suscribeButton" type="submit">
                                            <strong>Suscribirse</strong>
                                        </button>
                                        </h4>
                                    @else
                                        <strong>&nbsp; &nbsp;✓ Suscrito</strong>
                                        </h4>
                                    @endif  
                            </form>
                                
                        </div>
                    </div>
                    <div class="overflow-auto" id="divDescripcion"">
                        <p id="InfoVideoP" style="color: rgb(255,255,255);font-size: 21px;">{{$videoSeleccionado->descripcion}}<br></p>
                    </div>
                    <div id="divCategorias">
                        <div class="container col-5 float-end" id="categoriasContainer">
                            @foreach($arrayCategorias as $categoria) 
                            <button class="btn btn-primary botonCategoria" type="button">{{$categoria->nombre_categoria}}</button>
                            @endforeach
                        </div>
                        <h4 class="text-end col-4 float-start" id="categoriasP">Categorias:</h4>
                    </div>
                </div>
            </div>
        </div>
        <div id="valoracionDiv" class="d-flex">
            <div id="feedBackDiv" class = "row">
                <h3 id="valoraEsteVideo">Valora este video</h3>
                
                
                <form id="formLike" class="formFeedback col-2" method="POST" action="{{route('HacerFeedback', ['tipo_valoracion' => 1, 'id_usuario' => Auth::user()->id, 'id_video' => $videoSeleccionado->id])}}">
                @if ($feedbackDado == -1)
                <button class="btn btn-primary botonLike" id="likeButtom" onclick="myFunction()" type="submit"></form>
                    <i class="fa fa-thumbs-o-up botonLike" id="likeIcon"></i>&nbsp; {{$likes}}</button>
                <form id="formDislike" class="formFeedback col-2" method="POST" action="{{route('HacerFeedback', ['tipo_valoracion' => 0, 'id_usuario' => Auth::user()->id, 'id_video' => $videoSeleccionado->id])}}">
                    <button class="btn btn-primary botonDislike" id="dislikeButton" onclick="myFunction()" type="submit"></form>
                    <i class="fa fa-thumbs-o-down botonDislike" id="dislikeIcon"></i>&nbsp; {{$dislikes}}</button>
                @endif
                @if ($feedbackDado == 0)
                <button class="btn btn-primary botonLike" id="likeButtom" onclick="myFunction()" type="submit"></form>
                    <i class="fa fa-thumbs-o-up botonLike" id="likeIcon"></i>&nbsp; {{$likes}}</button>
                <form id="formDislike" class="formFeedback col-2" method="POST" action="{{route('HacerFeedback', ['tipo_valoracion' => 0, 'id_usuario' => Auth::user()->id, 'id_video' => $videoSeleccionado->id])}}">
                    <button class="btn btn-primary botonDislike" style = "color: var(--bs-red);" id="dislikeButton" onclick="myFunction()" type="submit"></form>
                    <i class="fa fa-thumbs-o-down botonDislike" id="dislikeIcon"></i>&nbsp; {{$dislikes}}</button>
                @endif
                @if ($feedbackDado == 1)
                <button class="btn btn-primary botonLike" id="likeButtom" style = "color : #adff2f;" onclick="myFunction()" type="submit"></form>
                    <i class="fa fa-thumbs-o-up botonLike" id="likeIcon"></i>&nbsp; {{$likes}}</button>
                <form id="formDislike" class="formFeedback col-2" method="POST" action="{{route('HacerFeedback', ['tipo_valoracion' => 0, 'id_usuario' => Auth::user()->id, 'id_video' => $videoSeleccionado->id])}}">
                    <button class="btn btn-primary botonDislike"  id="dislikeButton" onclick="myFunction()" type="submit"></form>
                    <i class="fa fa-thumbs-o-down botonDislike" id="dislikeIcon"></i>&nbsp; {{$dislikes}}</button>
                @endif

            </div>
            <div id="comentarioDiv">
                <form id="formularioComentario" method="POST" action="{{route('HacerComentario', ['id_video' => $videoSeleccionado->id, 'id_usuario' => Auth::user()->id])}}">
                    <h3 id="dejaComentario">Deja tu comentario</h3>
                    <input class="form-control" id="comentarioText" class="col-8" name="contenido"></input>
                        <button class="btn btn-primary" id="comentarioButton" type="submit">Enviar comentario</button>
                </form> 
            </div>
        </div>
        <div id="seccionComentariosDiv" class="container">
            <h4 id="comentariosHeading">Comentarios</h4>
            @foreach($comentariosUnidos as $comentario)
            <div id="comentariosDiv" class="col-7">
                <a id="comentador"><strong>{{$comentario[0]}}</strong></a>
                <p id="comentario">{{$comentario[1]}}<br></p>
            </div>
            @endforeach
        </div>
    </div>


    @else
        @include('includes.navbarNoLogin')
        @include('includes.mensajes')
        <div id="mainDiv" class="in-flex">
        <div id="tituloVideoDiv" class="row in-flex">
            <h1 id="tituloVideo" class="col-10">{{$videoSeleccionado->titulo_video}}</h1>
            <p id="reproduccionesYFecha" class="row col-5">{{$videoSeleccionado->visitas}} reproducciones</p>
        </div>
        <div class="float-none in-flex container" id="contenidoVideo">
            <div class="d-inline-flex flex-grow-0 flex-shrink-0 ratio ratio-16x9 container videoDiv" id="videoDiv" style="border: 4px solid rgb(255,255,255);">
                <h3 id = "registrateHeading">Registrate para ver el video</h3></div>
            <div id="infoVideoDiv" class="in-flex container">
                <div class="container" id="infoVideoContainer">
                    <div class="row" id="rowAutor">
                        <div class="col" style="border-bottom: 4px solid var(--bs-white) ;">
                            <h4 id="autorVideo">por: {{$autorVideo->username}}</h4>
                        </div>
                    </div>
                    <div class="overflow-auto" id="divDescripcion"">
                        <p id="InfoVideoP" style="color: rgb(255,255,255);font-size: 21px;">{{$videoSeleccionado->descripcion}}<br></p>
                    </div>
                    <div id="divCategorias">
                        <div class="container col-5 float-end" id="categoriasContainer">
                            @foreach($arrayCategorias as $categoria) 
                            <button class="btn btn-primary botonCategoria" type="button">{{$categoria->nombre_categoria}}</button>
                            @endforeach
                        </div>
                        <h4 class="text-end col-4 float-start" id="categoriasP">Categorias:</h4>
                    </div>
                </div>
            </div>
        </div>
        <div id="valoracionDiv" class="d-flex">
            <div id="feedBackDiv">
                <h3 id="valoraEsteVideo">Valora este video</h3>
                    <button class="btn btn-primary botonLike" id="likeButtom" type="button"><i class="fa fa-thumbs-o-up botonLike" id="likeIcon"></i>&nbsp; &nbsp; {{$likes}}
                    </button>
                    <button class="btn btn-primary botonDislike" id="dislikeButton" type="button"><i class="fa fa-thumbs-o-down botonDislike" id="dislikeIcon"></i>&nbsp; &nbsp; {{$dislikes}}
                    </button>
            </div>
            <div id="comentarioDiv">
                <h3 id="dejaComentario" style="text-color: rgb(255,255,255);">Ingresa para comentar este video</h3>
                    <h4>  </h4>
            </div>
        </div>
        <div id="seccionComentariosDiv" class="container">
            <h4 id="comentariosHeading">Comentarios</h4>
            @foreach($comentariosUnidos as $comentario)
            <div id="comentariosDiv" class="col-7">
                <a id="comentador"><strong>{{$comentario[0]}}</strong></a>
                <p id="comentario">{{$comentario[1]}}<br></p>
            </div>
            @endforeach
        </div>
    </div>
    @endauth
    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
</body>

</html>