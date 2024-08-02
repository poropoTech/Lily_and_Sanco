
window.ResponseCommentModal = function(object) {

    let responseId = object.responseId;
    let commentModalBtn = object.commentModalBtn;
    let commentModal = object.commentModal;
    let commentFeed = object.commentFeed;
    let commentModalForm = object.commentModalForm;
    let commentModalInput = object.commentModalInput;
    let commentModalFormSendBtn = object.commentModalFormSendBtn;
    let commentModalFormCounter = object.commentModalFormCounter;
    let carousel = object.carousel;

    $(commentModalBtn).click(function (e) {
        $(commentModal).modal();
        $(commentModal).modal('show');
    });

    $(commentModalInput).emojioneArea({
        useInternalCDN: true,
        search: false,
        recentEmojis: false,
        pickerPosition: "bottom",
        autocomplete: false,
        tones: false,
        filters: {
            recent : false, // disable recent
            smileys_people: {
                title: ''
            },
            animals_nature: {
                title: ''
            },
            food_drink: {
                title: ''
            },
            activity: {
                title: '',
            },
            travel_places: {
                title: '',
            },
            objects: {
                title: ''
            },
            symbols: {
                title: ''
            },
            flags : {
                icon: "flag_es",
                title: ''
            },
        }
    });

    $(commentModal).on('shown.bs.modal', function (e) {
        if (e.target.id === 'response-comment-modal-' + responseId) {
            if ($(carousel).length) {
                $(carousel).carousel('pause');
            }
            $.ajax({
                url: $(commentFeed).attr('data-comment-feed-url') + '?page=1',
                type: 'GET',
                success: function (data) {
                    $(commentFeed).html(data);
                    $(commentFeed).find('.response-comment').each(function () {
                        ResponseComment(this);
                    })
                }
            });

            $(commentFeed).infiniteScroll({
                path: $(commentFeed).attr('data-comment-feed-url') + '?page={{#}}',
                history: false,
                checkLastPage: '.feed-more-items',
                status: '#infinite-scroll-status-response-'+responseId,
                debug: false,
                append: false,
                elementScroll: true,
            });

            $(commentFeed).on( 'load.infiniteScroll', function( event, response ) {
                // get responses from response
                let $comments = $( response ).find('.response-comment');
                // append comments after images loaded
                $comments.each( function() {
                    ResponseComment(this);
                });
                $(commentFeed).infiniteScroll( 'appendItems', $comments );
            });

            $(commentFeed).on( 'last.infiniteScroll', function( event, response ) {
                $('#infinite-scroll-status-response-'+responseId).find('.infinite-scroll-last').addClass( 'infinite-scroll-status-last-page' );
                $('#infinite-scroll-status-response-'+responseId).addClass( 'infinite-scroll-status-last-page' );
            });
        }
    }).on('hide.bs.modal', function (e) {
        if (e.target.id === 'response-comment-modal-' + responseId) {
        }
    }).on('hidden.bs.modal', function (e) {
        if (e.target.id === 'response-comment-modal-' + responseId) {
            if ($(carousel).length) {
                $(carousel).carousel('cycle');
            }
            $(commentFeed).html('');
            $(commentFeed).infiniteScroll('destroy');
            $('#infinite-scroll-status-response-'+responseId).find('.infinite-scroll-last').removeClass( 'infinite-scroll-status-last-page' );
            $('#infinite-scroll-status-response-'+responseId).removeClass( 'infinite-scroll-status-last-page' );
        }
    });

    $(commentModalFormSendBtn).on('click', function (e) {
        commentModalForm.trigger('submit');
    });

    $(commentModalForm).on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: commentModalForm.attr('action'),
            type: 'POST',
            data: commentModalForm.serialize(),
            success: function(data){
                Swal.fire({
                    icon: 'success',
                    title: 'Bien!!',
                    text: 'Tu comentario se ha enviado',
                    backdrop: 'rgba(0,0,23,0.4) url(\"\") left top no-repeat',
                    onAfterClose: (obj) => {
                        // $(callerBtn).removeClass('activity-response-btn-todo')
                        // $(callerBtn).addClass('activity-response-btn-done activity-disabled');
                        // $(callerBtn).html('¡Desafío consegido!');

                        $(commentModalFormCounter).text(parseInt($(commentModalFormCounter).text())+ 1);
                        $(commentModal).modal('hide');
                    },
                })
            },
            error: function (data) {
                let swalText = '';

                switch(data.status) {
                    case 500:
                        swalText = data.responseJSON;
                        break;
                    case 422:
                        $(commentModalForm).find(':input').each(function(){
                            let inputName = $(this).attr('name');
                            if(inputName !== 'undefined' && data.responseJSON.errors.hasOwnProperty(inputName)){
                                swalText += data.responseJSON.errors[inputName] + '<br>';
                            }
                        });
                        break;
                    default:
                        swalText = 'Error no especificado.';
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Oops... ',
                    text: 'Algo ha ido mal',
                    html: swalText,
                    backdrop: 'rgba(0,0,23,0.4) url(\"\") left top no-repeat',
                })
            }
        });
    });
};




