@foreach($comments as $comment)
<div class="response-comment pb-2" data-response-comment-id="{{$comment->id}}">
    <div class="row">
        <div class="col-sm-1">
            <div class="row">
                <div class="col">
                    <img class="rounded-circle" style="max-height: 30px" src="{{ $comment->user->avatar }}" />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="d-flex">
                        <div >
                            <x-frontend.response.response-comment-delete :comment="$comment"/>
                        </div>
                        <div >
                            <x-frontend.response.response-comment-publish :comment="$comment"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-11 response-comment-text">
            <span><b>{{ $comment->user->alias }}</b>:</span><span> {{ $comment->content }}</span
            ><span><i> Hace {{ \Carbon\Carbon::now()->diffForHumans($comment->created_at, \Carbon\CarbonInterface::DIFF_ABSOLUTE)}}.</i></span>
        </div>
    </div>
</div>
@endforeach
@if(getSysSetting('app.responses.wall-comments-per-page') == count($comments))
    <div class="feed-more-items"></div>
@endif
