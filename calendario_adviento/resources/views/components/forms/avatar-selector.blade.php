<div id="avatar-selector-{{$id}}" class="avatar-selector">
    <input type="hidden" name="{{$name}}" id="avatar-selector-data-{{$id}}" class="avatar-selector-data">
    <input type="file" name="b{{$name}}" id="avatar-selector-input-{{$id}}" class="avatar-selector-input" accept="image/*" style="visibility: hidden; position: absolute">
    <button type="button" id="avatar-selector-browse-{{$id}}" class="{{$classBtn}} avatar-selector-browse">@lang('components_forms.avatar-selector.select_image')</button>
    <img height="{{$height}}" width="{{$width}}" src="{{$src ?? 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs='}}" id="avatar-selector-preview-{{$id}}" class="{{$classPreview}} avatar-selector-preview">

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="img-container">
                        <img class="avatar-selector-image" id="image" src="" style="max-width: 100%">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('components_forms.avatar-selector.cancel_button')</button>
                    <button type="button" class="btn btn-primary avatar-selector-crop-btn">@lang('components_forms.avatar-selector.select_button')</button>
                </div>
            </div>
        </div>
    </div>
</div>
