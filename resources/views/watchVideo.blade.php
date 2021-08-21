<!DOCTYPE html>
<html lang="es" style="transform: translate(0px);">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Visualización</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
</head>

<body id="body">
    @auth
        @include('includes.navbarLogin')
    @else
        @include('includes.navbarNoLogin')
    @endauth
    @include('includes.mensajes')

    <div id="mainDiv" class="in-flex">
        <div id="tituloVideoDiv" class="row in-flex">
            <h1 id="tituloVideo" class="row">Titulo Video</h1>
            <p id="reproduccionesYFecha" class="row col-5">Reproducciones - Fecha de subida</p>
        </div>
        <div class="float-none in-flex container" id="contenidoVideo">
            <div class="d-inline-flex flex-grow-0 flex-shrink-0 ratio ratio-16x9 container videoDiv" id="videoDiv"><iframe id="videoIframe" src="https://www.youtube.com/embed/jPr0A6J5iBI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
            <div id="infoVideoDiv" class="in-flex container">
                <div class="container" id="infoVideoContainer">
                    <div class="row" id="rowAutor">
                        <div class="col" style="border-bottom: 4px solid var(--bs-white) ;">
                            <h4 id="autorVideo">por: usernameAutor<button class="btn btn-primary" id="suscribeButton" type="button"><strong>Suscribirse</strong></button></h4>
                        </div>
                    </div>
                    <div class="overflow-auto" id="divDescripcion"">
                        <p id="InfoVideoP" style="color: rgb(255,255,255);font-size: 21px;">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reprehenderit, tempore dolore! Animi amet itaque qui nisi, cumque aliquam quae id saepe eaque perferendis blanditiis fuga iste assumenda ex, dolorem ab.
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reprehenderit, tempore dolore! Animi amet itaque qui nisi, cumque aliquam quae id saepe eaque perferendis blanditiis fuga iste assumenda ex, dolorem ab. syguhahasjhsaas sauhasjhsa usahjash ughsaahs sajsghsa hghsa gh hgahsab jgagsh h
                            <br></p>
                    </div>
                    <div id="divCategorias">
                        <div class="container col-5 float-end" id="categoriasContainer"><button class="btn btn-primary botonCategoria" type="button">Categoría1</button></div>
                        <h4 class="text-end col-4 float-start" id="categoriasP">Categorias:</h4>
                    </div>
                </div>
            </div>
        </div>
        <div id="valoracionDiv" class="d-flex">
            <div id="feedBackDiv">
                <h3 id="valoraEsteVideo">Valora este video</h3><button class="btn btn-primary botonLike" id="likeButtom" type="button"><i class="fa fa-thumbs-o-up botonLike" id="likeIcon"></i>&nbsp; &nbsp; 25</button><button class="btn btn-primary botonDislike" id="dislikeButton" type="button"><i class="fa fa-thumbs-o-down botonDislike" id="dislikeIcon"></i>&nbsp; &nbsp; 30</button>
            </div>
            <div id="comentarioDiv">
                <h3 id="dejaComentario">Deja tu comentario</h3><textarea id="comentarioText" class="col-8"></textarea><button class="btn btn-primary" id="comentarioButton" type="button">Enviar comentario</button>
            </div>
        </div>
        <div id="seccionComentariosDiv" class="row">
            <h4 id="comentariosHeading">Comentarios</h4>
            <div id="comentariosDiv" class="col-7">
                <p id="comentador"><strong>Héctor Ballesteros&nbsp;</strong><span class="m-2">25/11/2020</span></p>
                <p id="comentario">Lorem&nbsp;ipsum&nbsp;dolor&nbsp;sit&nbsp;amet&nbsp;consectetur&nbsp;adipisicing&nbsp;elit.&nbsp;Odio&nbsp;maxime&nbsp;aliquam&nbsp;porro&nbsp;fuga&nbsp;molestiae,&nbsp;sit&nbsp;iusto&nbsp;fugiat&nbsp;pariatur&nbsp;expedita&nbsp;sint&nbsp;mollitia&nbsp;officia&nbsp;architecto&nbsp;voluptate&nbsp;cumque,&nbsp;corporis&nbsp;ipsa,&nbsp;harum&nbsp;at&nbsp;dolorem?<br></p>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>