
window.ResponseCommentDelete =  function(object) {

    let deleteBtn = object.deleteBtn;
    let responseComment = object.responseComment;

    $(deleteBtn).click(function (e) {
        Swal.fire({
            title: '¿Seguro que quieres eliminar el comentario?',
            showCancelButton: true,
            confirmButtonText: 'Sí',
            cancelButtonText: 'No',
            icon: 'warning'
        }).then((result) => {
            if (result.value) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: $(deleteBtn).attr('x-data-response-comment-delete-url'),
                    type: 'POST',
                    data: '',
                    success: function(data, textStatus, xhr){
                        $(responseComment).remove();
                    },
                    error: function (data) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Algo ha ido mal',
                        })
                    }
                });
            }
        });
    });
};


