
window.ResponseDelete =  function(object) {

    let deleteBtn = object.deleteBtn;
    let responseCard = object.responseCard;

    $(deleteBtn).click(function (e) {
        Swal.fire({
            title: '¿Seguro que quieres eliminar el contenido?',
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
                    url: $(deleteBtn).attr('x-data-response-delete-url'),
                    type: 'POST',
                    data: '',
                    success: function(data, textStatus, xhr){
                        $(responseCard).remove();
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


