<div id="footer">
    <div class="footer full-width">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-6">
                    <div class= "footer-logo-container d-flex align-content-center">
                        <img src="{{ asset('img/logos/logo.png') }}" class="img-fluid footer-logo-img"  alt="Logo">
                        <div class="footer-logo-text align-self-center">
                            @lang('frontend_footer.text')
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="footer-links align-self-center ml-auto">
                        <ul class="footer-links-list">
                            <li>
                                <a href="{{ route('frontend.index') }}" class="text-dark">@lang('frontend_footer.links.item1')</a>
                            </li>
                            <li>
                                <a href="{{ route('frontend.pages.categories').'/' }}" class="text-dark">@lang('frontend_footer.links.item2')</a>
                            </li>
                            <li>
                                <a href="{{ route('frontend.pages.wall').'/' }}" class="text-dark">@lang('frontend_footer.links.item3')</a>
                            </li>
                            <li>
                                <a href="{{ route('frontend.index').'/#progreso' }}" class="text-dark">@lang('frontend_footer.links.item4')</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer2 full-width">
        <div class="container">
            <span class="footer-copyright">&#169;2021 Eventos online belong to sea</span>
        </div>
    </div>
</div>
