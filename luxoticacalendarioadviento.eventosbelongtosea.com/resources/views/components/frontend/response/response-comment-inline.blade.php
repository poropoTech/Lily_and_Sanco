<div class="response-comment-inline" data-response-comment-id="{{ $response->id }}">
    <div id="response-comment-inline-comments-{{ $response->id }}" class="response-comment-inline-comments" data-comment-feed-url="{{ route('frontend.responses.comment_feed', ['response' => $response->id]).'?page=1&view=inline' }}">
    @foreach($response->getLastComments($logged_in_user, 5) as $comment)
            <div class="response-inline-comment">
                <span><b>{{ $comment->user->alias }}</b>: </span><span>{{ $comment->content }}</span><span><i> Hace {{ \Carbon\Carbon::now()->diffForHumans($comment->created_at, \Carbon\CarbonInterface::DIFF_ABSOLUTE)}}.</i></span>
            </div>
    @endforeach
    </div>
    <x-forms.post id="response-comment-inline-form-{{ $response->id }}" action="{{ route('frontend.responses.comment', ['response' => $response->id]) }}">
        <div class="d-flex">
            <input type="text" id="response-comment-inline-form-input-{{ $response->id }}" class="form-control emoji-text-input" name="content"  placeholder="@lang('components_frontend.response.comment-inline.comment_placeholder')">
            <button type="button" id="response-comment-inline-send-btn-{{ $response->id }}" class="btn btn-outline-primary border-0 shadow-none"><i class="far fa-paper-plane"></i></button>
        </div>
    </x-forms.post>
</div>
