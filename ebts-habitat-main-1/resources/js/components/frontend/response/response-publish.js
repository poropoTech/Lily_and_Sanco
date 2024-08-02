
window.ResponsePublish =  function(object) {

    let publishBtn = object.publishBtn;

    $(publishBtn).click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: $(this).attr('x-data-response-publish-url'),
            type: 'POST',
            data: '',
            success: function(data, textStatus, xhr){
                if(xhr.status === 200) {
                    if(data === 'Published') {
                        $(publishBtn).find('i').removeClass('fa-eye-slash text-danger');
                        $(publishBtn).find('i').addClass('fa-eye text-success');
                    }
                    else if( data === 'NotPublished') {
                        $(publishBtn).find('i').addClass('fa-eye-slash text-danger');
                        $(publishBtn).find('i').removeClass('fa-eye text-success');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Algo ha ido mal',
                        });
                    }
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


