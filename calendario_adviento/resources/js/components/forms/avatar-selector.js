$(function () {
    $('.avatar-selector-browse').each(function(){
        $(this).click(function (e) {
            $(this).siblings('.avatar-selector-input').trigger("click");
        });
    });

    $('.avatar-selector').each(function(){

        var avatar = $(this).find('.avatar-selector-preview')[0];
        var image = $(this).find('.avatar-selector-image')[0];
        var input = $(this).find('.avatar-selector-input')[0];
        var $output = $(this).find('.avatar-selector-data').first();

        var cropBtn = $(this).find('.avatar-selector-crop-btn')[0];
        var $modal = $(this).find('.modal').first();
        var cropper;

        $('[data-toggle="tooltip"]').tooltip();

        input.addEventListener('change', function (e) {
            var files = e.target.files;
            var done = function (url) {
                input.value = '';
                image.src = url;
                $modal.modal('show');
            };
            var reader;
            var file;
            var url;

            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        $modal.on('shown.bs.modal', function () {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
            });
        }).on('hidden.bs.modal', function () {
            cropper.destroy();
            cropper = null;
        });

        cropBtn.addEventListener('click', function () {
            var initialAvatarURL;
            var canvas;

            $modal.modal('hide');

            if (cropper) {
                canvas = cropper.getCroppedCanvas({
                    width: 300,
                    height: 300,
                });
                initialAvatarURL = avatar.src;
                avatar.src = canvas.toDataURL();
                $output.val(canvas.toDataURL());
            }
        });
    });
});
