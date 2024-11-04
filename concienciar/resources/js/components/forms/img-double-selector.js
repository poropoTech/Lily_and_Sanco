window.ImageDoubleSelector = function (responseItem) {

    let preview1 = $(responseItem).find('.image-double-selector-preview1')[0];
    let preview2 = $(responseItem).find('.image-double-selector-preview2')[0];
    let image1 = $(responseItem).find('.image-double-selector-image1')[0];
    let image2 = $(responseItem).find('.image-double-selector-image2')[0];
    let input = $(responseItem).find('.image-double-selector-input')[0];
    let $output1 = $(responseItem).find('.image-double-selector-data1');
    let $output2 = $(responseItem).find('.image-double-selector-data2');
    let browseBtn = $(responseItem).find('.image-double-selector-browse')[0];
    let deleteBtn = $(responseItem).find('.image-double-selector-delete')[0];

    let cropBtn = $(responseItem).find('.image-double-selector-crop-btn')[0];
    let cancelBtn = $(responseItem).find('.image-double-selector-cancel-btn')[0];
    let $modal = $(responseItem).find('.image-double-selector-modal');
    let cropper1;
    let cropper2;

    $(browseBtn).click(function (e) {
        $(this).siblings('.image-double-selector-input').trigger("click");
    });


    $(deleteBtn).click(function (e) {
        $(this).siblings('.image-double-selector-data1').val("");
        $(this).siblings('.image-double-selector-data2').val("");
        $(this).siblings('.image-double-selector-delete-data').val("1");
        $(this).siblings('.image-double-selector-preview1').attr("src", "data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=");
        $(this).siblings('.image-double-selector-preview2').attr("src", "data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=");
    });


    input.addEventListener('change', function (e) {
        let files = e.target.files;
        let done = function (url) {
            if (file.type.includes('svg')) {
                let reader2 = new window.FileReader();
                reader2.readAsDataURL(file);
                reader2.onload = function () {
                    $output1.val(reader2.result);
                    $output2.val(reader2.result);
                };

                input.value = '';
                preview1.src = url;
                preview2.src = url;
            } else {
                input.value = '';
                image1.src = url;
                image2.src = url;
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

        let outCroppedWidth1 = preview1.getAttribute('width') * preview1.getAttribute('resFactor');
        let outCroppedHeight1 = preview1.getAttribute('height') * preview1.getAttribute('resFactor');
        let minCroppedWidth1 = preview1.getAttribute('width') * preview1.getAttribute('minResFactor');
        let minCroppedHeight1 = preview1.getAttribute('height') * preview1.getAttribute('minResFactor');
        let maxCroppedWidth1 = preview1.getAttribute('width') * preview1.getAttribute('maxResFactor');
        let maxCroppedHeight1 = preview1.getAttribute('height') * preview1.getAttribute('maxResFactor');

        let outCroppedWidth2 = preview2.getAttribute('width') * preview2.getAttribute('resFactor');
        let outCroppedHeight2 = preview2.getAttribute('height') * preview2.getAttribute('resFactor');
        let minCroppedWidth2 = preview2.getAttribute('width') * preview2.getAttribute('minResFactor');
        let minCroppedHeight2 = preview2.getAttribute('height') * preview2.getAttribute('minResFactor');
        let maxCroppedWidth2 = preview2.getAttribute('width') * preview2.getAttribute('maxResFactor');
        let maxCroppedHeight2 = preview2.getAttribute('height') * preview2.getAttribute('maxResFactor');
        cropper1 = new Cropper(image1, {
            aspectRatio: preview1.getAttribute('width') / preview1.getAttribute('height'),
            viewMode: 3,
            data: {
                width: minCroppedWidth1 ,
                height: minCroppedHeight1,
            },
            crop: function (event) {
                let width = event.detail.width;
                let height = event.detail.height;

                if (
                    width < minCroppedWidth1
                    || height < minCroppedHeight1
                    || width > maxCroppedWidth1
                    || height > maxCroppedHeight1
                ) {
                    cropper1.setData({
                        width: Math.max(minCroppedWidth1, Math.min(maxCroppedWidth1, width)),
                        height: Math.max(minCroppedHeight1, Math.min(maxCroppedHeight1, height)),
                    });
                }
            }
        });

        cropper1['outCroppedWidth'] = outCroppedWidth1;
        cropper1['outCroppedHeight'] = outCroppedHeight1;

        cropper2 = new Cropper(image2, {
            aspectRatio: preview2.getAttribute('width') / preview2.getAttribute('height'),
            viewMode: 3,
            data: {
                width: minCroppedWidth2,
                height: minCroppedHeight2,
            },
            crop: function (event) {
                let width = event.detail.width;
                let height = event.detail.height;

                if (
                    width < minCroppedWidth2
                    || height < minCroppedHeight2
                    || width > maxCroppedWidth2
                    || height > maxCroppedHeight2
                ) {
                    cropper2.setData({
                        width: Math.max(minCroppedWidth2, Math.min(maxCroppedWidth2, width)),
                        height: Math.max(minCroppedHeight2, Math.min(maxCroppedHeight2, height)),
                    });
                }
            }
        });

        cropper2['outCroppedWidth'] = outCroppedWidth2;
        cropper2['outCroppedHeight'] = outCroppedHeight2;

    }).on('hidden.bs.modal', function () {
        cropper1.destroy();
        cropper1 = null;
        cropper2.destroy();
        cropper2 = null;
    });

    cropBtn.addEventListener('click', function () {
        let canvas;

        if (cropper1) {
            canvas = cropper1.getCroppedCanvas({
                width: cropper1.outCroppedWidth,
                height: cropper1.outCroppedHeight,
                imageSmoothingEnabled: false,
                imageSmoothingQuality: 'high',
            });
            preview1.src = canvas.toDataURL('image/jpeg');
            $output1.val(canvas.toDataURL('image/jpeg'));
        }

        if (cropper2) {
            canvas = cropper2.getCroppedCanvas({
                width: cropper2.outCroppedWidth,
                height: cropper2.outCroppedHeight,
                imageSmoothingEnabled: false,
                imageSmoothingQuality: 'high',
            });
            preview2.src = canvas.toDataURL('image/jpeg');
            $output2.val(canvas.toDataURL('image/jpeg'));
        }

        $modal.modal('hide');
    });

    cancelBtn.addEventListener('click', function () {
        $modal.modal('hide');
    });
};

$('.image-double-selector').each(function(){
    ImageDoubleSelector(this);
});
