{{--<span class="btn response-comment response-card-actions response-card-actions-comment" data-response-comment-id="{{ $response->id }}">--}}
{{--    <i class="fas ar fa-comment"></i><span class="response-comment-counter-{{ $response->id }}" style="padding-left: 5px;">{{ $response->comments()->count() }}</span>--}}
{{--</span>--}}

<div class="modal fade response-comment-modal" id="response-comment-modal-{{ $response->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="response-comment-modal-form-comments" id="response-comment-modal-comments-{{ $response->id }}" data-comment-feed-url="{{ route('frontend.responses.comment_feed', ['response' => $response->id]) }}">

                </div>

                <x-forms.post id="response-comment-modal-form-{{ $response->id }}" action="{{ route('frontend.responses.comment', ['response' => $response->id]) }}">
                    <div class="form-group row">
                        <div class="col-md-12 py-1">
                            <textarea id="response-comment-modal-form-input-{{ $response->id }}" class="form-control emoji-text-input"  name="content" rows="3" placeholder="Comentario">   </textarea>
                        </div>
                    </div><!--form-group-->
                </x-forms.post>
                <div class="row" style="height: 40px;">
                    <div class="col text-center">
                        <x-utils.infinite-scroll-status id="response-{{ $response->id }}"/>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="response-comment-modal-cancel-btn" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban"></i></button>
                <button type="button" id="response-comment-modal-send-btn-{{ $response->id }}" class="btn btn-primary"><i class="fa fa-paper-plane"></i></button>
            </div>
        </div>
    </div>
</div>
