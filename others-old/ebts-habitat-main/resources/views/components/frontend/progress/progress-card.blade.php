
<div class="row progress-card">
    <div class="col-md-12 d-flex">
        <div>
            <div class="progress-card-img-container progress-card-img-animation-{{$progress['step']}}">
                <img class="img-fluid progress-card-img" src="{{ $progress['image'] }}">
            </div>
            <div class="progress-card-percent">
                {{ $progress['progress'] }}%
            </div>
        </div>
        <div class="progress-card-img-container progress-card-img-bar" >
            <div class="ldBar"
                 style="height:300px; padding-right: 20px"
                 data-fill-background-extrude="0"
                 data-fill-background="#bdbdbd"
                 data-value="{{ $progress['progress'] }}"
                 data-type="fill"
                 data-img="{{ asset('img/progress/progress-bar.svg') }}"
            ></div>
        </div>
    </div>
</div>
