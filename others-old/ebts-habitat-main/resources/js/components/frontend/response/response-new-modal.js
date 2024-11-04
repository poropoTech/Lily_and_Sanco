    var responseModalNewObserver;

$(function () {
    let responseModal;
    let responseModalForm;
    let responseModalFormBtn;
    let callerBtn;
    let counterSpan;
    let activityId;

    $('.activity-response-btn').each(function(){
        $(this).click(function (e) {
            if($(this).attr('disabled')){
                return;
            }

            callerBtn = this;
            activityId = $(this).attr('data-response-new-modal-id');
            counterSpan = $($(this).attr('data-response-new-modal-counter'));

            $.ajax({
                url: $(callerBtn).attr('data-response-new-url'),
                type: 'GET',
                success: function (data) {
                    $('#response-new-modal-container').html(data);
                    responseModal = $('#response-new-modal-container').find('#response-new-modal');
                    responseModalForm = $(responseModal).find('#response-new-modal-form');
                    responseModalFormBtn = $(responseModal).find('#response-new-modal-send-btn');
                    $(responseModal).find('#response-new-modal-activity-id').val(activityId);
                    if (!ResponseAutosubmit(responseModal)) {
                        ResponseEmojiInput(responseModal);
                        ResponseImageSelector(responseModal);
                        ResponseFileSelector(responseModal);
                        $(responseModal).modal();
                    }
                },
                error: function (data) {
                    let swalText = '';

                    switch(data.status) {
                        case 500:
                            swalText = data.responseJSON;
                            break;
                        case 422:
                            $(responseModalForm).find(':input').each(function(){
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

            $(document).on('click', '#response-new-modal-send-btn', function (e) {
                $('#response-new-modal-form').trigger('submit');
            });

            $(document).on('submit', '#response-new-modal-form', function(e){

                var form = $('#response-new-modal-form')[0];

                var data = new FormData(form);

                e.preventDefault();
                $.ajax({
                    url: responseModalForm.attr('action'),
                    type: 'POST',
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    data: data,
                    success: function(data, textStatus, xhr){
                        Swal.fire({
                            icon: 'success',
                            title: '¡Bien!',
                            text: 'Cada desafío aceptado nos acerca más a nuestro objetivo.',
                            backdrop: 'url(\"/img/progress/confetti.gif\") left top repeat',
                            onAfterClose: (obj) => {
                                location.reload();
                                // $(callerBtn).removeClass('activity-response-btn-todo')
                                // $(callerBtn).addClass('activity-response-btn-done activity-disabled');
                                // $(callerBtn).html('¡Desafío consegido!');
                                // if ($(counterSpan).length) {
                                //     $(counterSpan).text(parseInt($(counterSpan).text())+ 1);
                                // }
                                // $(responseModal).modal('hide');
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
                                $(responseModalForm).find(':input').each(function(){
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
        });
    });



    $(document).on('shown.bs.modal', function (e) {
        if (e.target.id === 'response-new-modal') {


            responseModalNewObserver = new CustObs(document.querySelector('body'),{'attributes': true},function(observer,mutations){
                responseModalNewObserver.disconnect();
                if(!$('body').hasClass('modal-open')) {
                    $('body').addClass('modal-open');
                }
                responseModalNewObserver.connect();
            });
            responseModalNewObserver.connect();
        }

    }).on('hide.bs.modal', function (e) {
        if (e.target.id === 'response-new-modal') {
            responseModalNewObserver.disconnect();
            //responseModalNewObserver = null;
        }
    }).on('hidden.bs.modal', function (e) {
        if (e.target.id === 'response-new-modal') {
            responseModalForm.trigger('reset');
            $(responseModalForm).find(':input.emoji-text-input[type="text"], textarea.emoji-text-input').each(function(i){
                this.emojioneArea.setText('');
            });
            $(responseModalForm).find('#collapseOne').collapse('show');
            $(responseModalForm).find('.image-selector-data').val('');
            $(responseModalForm).find('.image-selector-preview').attr('src', 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=');
            $(document).off('click', '#response-new-modal-send-btn');
            $(document).off('submit', '#response-new-modal-form');
        }
    });
});

