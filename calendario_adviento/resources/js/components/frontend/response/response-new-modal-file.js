window.ResponseFileSelector = function(responseModal) {

    $(responseModal).find('.custom-file-input').each(function(i){
        $(this).on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
        });
    });
};
