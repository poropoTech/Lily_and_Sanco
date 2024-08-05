window.ResponseImageSelector = function(responseModal) {

    $(responseModal).find('.image-selector-browse').each(function(){
        $(this).click(function (e) {
            $(this).siblings('.image-selector-input').trigger("click");
        });
    });

    $(responseModal).find('.image-selector-delete').each(function(){
        $(this).click(function (e) {
            $(this).siblings('.image-selector-data').val("");
            $(this).siblings('.image-selector-delete-data').val("1");
            $(this).siblings('.image-selector-preview').attr("src","data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=");
        });
    });

    $(responseModal).find('.image-selector').each(function(){

        let preview = $(this).find('.image-selector-preview')[0];
        let image = $(this).find('.image-selector-image')[0];
        let input = $(this).find('.image-selector-input')[0];
        let $output = $(this).find('.image-selector-data').first();

        let cropBtn = $(this).find('.image-selector-crop-btn')[0];
        let cancelBtn = $(this).find('.image-selector-cancel-btn')[0];
        let $modal = $(this).find('.image-selector-modal').first();
        let cropper;

        $(this).find('[data-toggle="tooltip"]').tooltip();

        input.addEventListener('change', function (e) {
            let files = e.target.files;
            let done = function (url) {
                if(file.type.includes('svg')){
                    let reader2 = new window.FileReader();
                    reader2.readAsDataURL(file);
                    reader2.onload = function () {
                        $output.val(reader2.result);
                    };

                    input.value = '';
                    preview.src = url;
                }else {
                    input.value = '';
                    image.src = url;
                    $modal.modal('show');
                }
            };
            let reader;
            let file;
            let url;

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
            let outCroppedWidth = preview.getAttribute('width') * preview.getAttribute('resFactor');
            let outCroppedHeight = preview.getAttribute('height') * preview.getAttribute('resFactor');
            let minCroppedWidth = preview.getAttribute('width') * preview.getAttribute('minResFactor');
            let minCroppedHeight = preview.getAttribute('height') * preview.getAttribute('minResFactor');
            let maxCroppedWidth = preview.getAttribute('width') * preview.getAttribute('maxResFactor');
            let maxCroppedHeight = preview.getAttribute('height') * preview.getAttribute('maxResFactor');
                cropper = new Cropper(image, {
                aspectRatio: preview.getAttribute('width') / preview.getAttribute('height'),
                viewMode: 3,
                data: {
                    width: minCroppedWidth,
                    height: minCroppedHeight,
                },
                crop: function (event) {
                    let width = event.detail.width;
                    let height = event.detail.height;

                    if (
                        width < minCroppedWidth
                        || height < minCroppedHeight
                        || width > maxCroppedWidth
                        || height > maxCroppedHeight
                    ) {
                        cropper.setData({
                            width: Math.max(minCroppedWidth, Math.min(maxCroppedWidth, width)),
                            height: Math.max(minCroppedHeight, Math.min(maxCroppedHeight, height)),
                        });
                    }
                }
            });

            cropper['outCroppedWidth'] = outCroppedWidth;
            cropper['outCroppedHeight'] = outCroppedHeight;

        }).on('hidden.bs.modal', function () {
            cropper.destroy();
            cropper = null;
        });

        cropBtn.addEventListener('click', function () {
            let canvas;

            $modal.modal('hide');

            if (cropper) {
                canvas = cropper.getCroppedCanvas({
                    width: cropper.outCroppedWidth,
                    height: cropper.outCroppedHeight,
                    imageSmoothingEnabled: false,
                    imageSmoothingQuality: 'high',
                });
                preview.src = canvas.toDataURL('image/jpeg');
                $output.val(canvas.toDataURL('image/jpeg'));
            }
        });

        cancelBtn.addEventListener('click', function () {
            $modal.modal('hide');
        });
    });
};
