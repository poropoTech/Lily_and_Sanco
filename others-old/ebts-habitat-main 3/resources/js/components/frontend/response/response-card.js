
window.ResponseCard = function(responseItem) {

    let responseId = $(responseItem).attr('data-response-id');

    ResponseCommentModal({
        responseId: responseId,
        commentModalBtn: $(responseItem).find('.response-card-comment-btn'),
        commentModal: $(responseItem).find('#response-comment-modal-' + responseId),
        commentFeed: $(responseItem).find('#response-comment-modal-comments-' + responseId),
        commentModalForm:  $(responseItem).find('#response-comment-modal-form-' + responseId),
        commentModalInput: $(responseItem).find('#response-comment-modal-form-input-' + responseId),
        commentModalFormSendBtn:  $(responseItem).find('#response-comment-modal-send-btn-' + responseId),
        commentModalFormCounter : $(responseItem).find('.response-card-comment-counter'),
        carousel: $(responseItem).parents('.carousel').get(0),
    });

    ResponseLike({
        likeBtn: $(responseItem).find('.response-like'),
        likeCounter: $(responseItem).find('.response-card-like-counter'),
    });

    ResponsePublish({
        publishBtn: $(responseItem).find('.response-publish'),
    });

    ResponseDelete({
        deleteBtn: $(responseItem).find('.response-delete'),
        responseCard: responseItem,
    });


    ResponseCommentInLine({
        responseId: responseId,
        commentInlineForm: $(responseItem).find('#response-comment-inline-form-' + responseId),
        commentInlineFormSendBtn: $(responseItem).find('#response-comment-inline-send-btn-' + responseId),
        commentInlineFormCounter: $(responseItem).find('.response-card-comment-counter'),
        commentInlineComments:  $(responseItem).find('#response-comment-inline-comments-' + responseId),
        commentInlineInput: $(responseItem).find('#response-comment-inline-form-input-' + responseId),
    });
};

$(function () {
    $('.response-card').each(function(){
        ResponseCard(this);
    });
});



