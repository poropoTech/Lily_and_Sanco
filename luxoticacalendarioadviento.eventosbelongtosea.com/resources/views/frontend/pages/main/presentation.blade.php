<div class="row">
    <div class="col-md-6 pt-md-5">
        @lang('frontend_pages_main.sections.presentation.text')
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-primary"
                   href="{{ route('frontend.pages.knowmore') }}">@lang('frontend_pages_main.sections.presentation.button')</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 d-flex justify-content-center">
        <div class="main-presentation-img-container">
            <img class="img-fluid" src="{{ asset('/img/pages/home/rounded.png') }}">
        </div>
    </div>
</div>

