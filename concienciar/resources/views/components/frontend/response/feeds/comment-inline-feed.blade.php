@foreach($comments as $comment)
<div class="response-comment">
    <span><b>{{ $comment->user->alias }}</b>: </span><span>{{ $comment->content }} </span>
    <span><i>Hace {{ \Carbon\Carbon::now()->diffForHumans($comment->created_at, \Carbon\CarbonInterface::DIFF_ABSOLUTE)}}.</i></span>
</div>
@endforeach
