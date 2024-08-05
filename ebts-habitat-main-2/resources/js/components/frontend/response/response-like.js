
window.ResponseLike =  function(object) {

    let likeBtn = object.likeBtn;
    let likeCounter = object.likeCounter;

    $(likeBtn).click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: $(this).attr('x-data'),
            type: 'POST',
            data: '',
            success: function(data, textStatus, xhr){
                if(xhr.status === 201) {
                    $(likeBtn).find('i').addClass('text-danger');
                    $(likeCounter).text(parseInt($(likeCounter).text()) + 1);
                }
                if(xhr.status === 204) {
                    $(likeBtn).find('i').removeClass('text-danger');
                    $(likeCounter).text(parseInt($(likeCounter).text()) - 1);
                }

            },
            error: function (data) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Algo ha ido mal',
                })
            }
        });
    });
};


