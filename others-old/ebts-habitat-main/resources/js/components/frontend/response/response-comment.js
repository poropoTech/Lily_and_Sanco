
window.ResponseComment = function(responseComment) {

    let commentId = $(responseComment).attr('data-response-comment-id');

    ResponseCommentPublish({
        publishBtn: $(responseComment).find('.response-comment-publish'),
    });

    ResponseCommentDelete({
        deleteBtn: $(responseComment).find('.response-comment-delete'),
        responseComment: responseComment,
    });
};




