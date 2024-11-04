@extends('frontend.layouts.app')

@section('title', __('Saber más'))

@section('content')

{{--    <div class="page-header-img-container">--}}
{{--        <img class="img-fluid" src="{{asset('/img/pages/knowmore/header.png') }}">--}}
{{--    </div>--}}
    <div class="page-header-video-container">
        <video autoplay muted loop src="{{ asset('video/header.mp4') }}" ></video>
    </div>
    <div class="container pt-4 knowmore-page-container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <div class="knowmore-title-container">
                            <h1 class="knowmore-title1">POR UN BIENESTAR GLOBAL.</h1>
                            <h1 class="knowmore-title2">CONCIENCIAR</h1>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="knowmore-img-container">
                            <img class="img-fluid knowmore-img" src="{{asset('/img/pages/knowmore/rounded.png') }}">
                        </div>
                    </div>
                </div>
            </div><!--col-md-6-->
            <div class="col-md-6 knowmore-text">
                <p class="knowmore-highlight-text">Cuidarse a uno mismo empieza por cuidar de
                    nuestro entorno.</p>
                <p>Si nos preocupa nuestro propio bienestar también debería
                    preocuparnos el bienestar del entorno en el que vivimos.</p>
                <p><strong>La suma de las pequeñas acciones individuales conseguirá un
                        gran impacto global.</strong>Mantener buenos hábitos en el tiempo dará
                    lugar a grandes cambios y minimizará nuestra huella en el planeta.</p>
                <p>Cada día realizamos un montón de acciones y actividades en
                    nuestro día a día que pueden tener efectos más o menos agresivos
                    sobre el medio ambiente: la energía que utilizamos, la forma de
                    trasladarnos, el reciclaje de los residuos que generamos, la
                    reutilización de objetos cotidianos, el consumo del agua...</p>
                <p> Por tanto, debemos actuar, en la medida de lo posible, de forma que
                    los efectos de nuestras acciones impacten lo menos posible.</p>
                <p> <strong>Respetar el entorno y la naturaleza nos debe llevar a cambiar
                        nuestra forma de vivir y nuestra actitud hacia el mundo y hacia
                        nosotros mismos.</strong>En nuestra vida cotidiana las personas podemos
                    realizar multitud de acciones que contribuyan a la mejora del
                    entorno a partir del respeto de los lugares donde vivimos.
                </p>
                <p>Por ello queremos animarte a que realices estos sencillas y
                    divertidas actividades que hemos preparado, no sólo aprenderás y
                    aplicarás nuevos hábitos más sostenibles en tu día a día, también te
                    acercarán más a tus compañeros de trabajo.</p>
                <p>Eres de los que llevan años de ventaja en materia de sostenibilidad
                    o tienes todavía mucho que aprender de tus compañeros?</p>
                <p>Descúbrelo a través de estos desafíos que hemos preparado para ti
                    y todo el equipo!</p>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div>
                            <a href="{{url()->previous()}}" role="button" class="big-link"><i class="cil-arrow-left"></i> Volver</a>
                        </div>
                    </div>
                </div>
            </div><!--col-md-6-->
        </div><!--row-->
    </div><!--container-->
@endsection
