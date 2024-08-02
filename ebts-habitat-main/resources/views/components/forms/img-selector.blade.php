<div id="image-selector-{{$id}}" class="image-selector">
    <input type="hidden" name="{{$name}}" id="image-selector-data-{{$id}}" class="image-selector-data">
    <input type="file" name="b{{$name}}" id="image-selector-input-{{$id}}" class="image-selector-input" accept="image/*" style="visibility: hidden; position: absolute">
    <button type="button" id="image-selector-browse-{{$id}}" class="{{$classBrowseBtn}} image-selector-browse">Selecciona imágen</button>
    <img class="{{$classPreview}} image-selector-preview" height="{{$height}}" width="{{$width}}" resFactor="{{ $resFactor ?? 1 }}" minResFactor="{{ $minResFactor ?? 1 }}" maxResFactor="{{ $maxResFactor ?? 1 }}" src="{{$src ?? 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs='}}" id="image-selector-preview-{{$id}}">

    <div class="modal fade image-selector-modal" id="image-selector-modal-{{$id}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="img-container">
                        <img class="image-selector-image" id="image-selector-image-{{$id}}" src="" style="max-width: 100%">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary image-selector-cancel-btn">Cancelar</button>
                    <button type="button" class="btn btn-primary image-selector-crop-btn">Seleccionar</button>
                </div>
            </div>
        </div>
    </div>
</div>
