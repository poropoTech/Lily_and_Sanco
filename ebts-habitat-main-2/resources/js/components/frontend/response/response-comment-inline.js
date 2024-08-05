
window.ResponseCommentInLine = function(object) {

    let responseId = object.responseId;
    let commentInlineForm = object.commentInlineForm;
    let commentInlineFormSendBtn = object.commentInlineFormSendBtn;
    let commentInlineFormCounter = object.commentInlineFormCounter;
    let commentInlineComments = object.commentInlineComments;
    let commentInlineInput = object.commentInlineInput;

    $(commentInlineInput).emojioneArea({
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

    // $.ajax({
    //     url: commentInlineComments.attr('data-comment-feed-url'),
    //     type: 'GET',
    //     success: function (data) {
    //         $(commentInlineComments).html(data);
    //     }
    // });

    $(commentInlineFormSendBtn).on('click', function (e) {
        commentInlineForm.trigger('submit');
    });

    $(commentInlineForm).on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: commentInlineForm.attr('action'),
            type: 'POST',
            data: commentInlineForm.serialize(),
            success: function(data){
                $.ajax({
                    url: commentInlineComments.attr('data-comment-feed-url'),
                    type: 'GET',
                    success: function (data) {
                        $(commentInlineComments).html(data);
                    }
                });
                $(commentInlineForm).find(':input.emoji-text-input[type="text"], textarea.emoji-text-input').each(function(i){
                    this.emojioneArea.setText('');
                });
                $(commentInlineFormCounter).text(parseInt($(commentInlineFormCounter).text())+ 1);
            },
            error: function (data) {
                let swalText = '';

                switch(data.status) {
                    case 500:
                        swalText = data.responseJSON;
                        break;
                    case 422:
                        $(commentInlineForm).find(':input').each(function(){
                            let inputName = $(this).attr('name');
                            if(inputName != 'undefined' && data.responseJSON.errors.hasOwnProperty(inputName)){
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


