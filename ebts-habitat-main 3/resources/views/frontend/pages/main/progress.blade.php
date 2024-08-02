<div class="row justify-content-center">
    <div class="col-md-4 text-left">
        <h2>Objetivo</h2>
        <p>Gracias a ti y todos tus compañeros esta tortuga
            está cada vez más libre de todos los plásticos que
            le impiden nadar y vivir con total libertad.
            Tus pequeñas acciones individuales y colectivas,
            nos acercan cada vez más a nuestro objetivo final.
        </p>
        <p>¡Sigue así!</p>
        <div class="main-progress-percent">
            {{ $progress['progress'] }}%
        </div>
    </div>
    <div class="col-md-6 text-center">
        <div class="row align-content-center">
            <div class="col-md-12 d-flex">
                <div class="main-progress-img-container main-progress-img-animation-{{$progress['step']}}">
                    <img class="img-fluid main-progress-img" src="{{ $progress['image'] }}">
                </div>
                <div class="main-progress-img-container main-progress-img-bar" >
                    <div class="ldBar"
                         data-fill-background-extrude="0"
                         data-fill-background="#bdbdbd"
                         data-value="{{ $progress['progress'] }}"
                         data-type="fill"
                         data-img="{{ asset('img/progress/progress-bar.svg') }}"
                    ></div>
                </div>
            </div>
        </div>
    </div>
</div>

