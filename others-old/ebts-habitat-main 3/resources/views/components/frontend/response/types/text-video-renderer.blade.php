<div class="response-card-embed-container">
    @switch($response->ext_content_type)
        @case('Youtube')
            <iframe src="https://www.youtube.com/embed/{{ $response->ext_content }}" frameborder="0" allowfullscreen></iframe>
            @break
        @case('Vimeo')
            <iframe src="https://player.vimeo.com/video/{{ $response->ext_content }}" frameborder="0" allowfullscreen></iframe>
            @break
        @endswitch
</div>
