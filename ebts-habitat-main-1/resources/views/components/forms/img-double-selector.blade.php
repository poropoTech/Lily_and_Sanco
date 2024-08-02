<div id="image-double-selector-{{$id}}" class="image-double-selector">
    <div class="row">
        <div class="col-md-2">
            <input type="hidden" name="{{$name1}}" id="image-double-selector-data1-{{$id}}" class="image-double-selector-data1">
            <input type="hidden" name="{{$name2}}" id="image-double-selector-data2-{{$id}}" class="image-double-selector-data2">
            <input type="hidden" name="delete-images" id="image-selector-delete-{{$id}}" class="image-selector-delete-data" value="0">
            <input type="file" name="input-image" id="image-double-selector-input-{{$id}}" class="image-double-selector-input" accept="image/*" style="visibility: hidden; position: absolute">
            <button type="button" id="image-double-selector-browse-{{$id}}" class="{{$classBrowseBtn}} image-double-selector-browse">Selecciona imágen</button>
{{--            <button type="button" id="image-double-selector-delete-{{$id}}" class="{{$classDeleteBtn}} image-double-selector-delete">Eliminar</button>--}}

        </div>
        <div class="col-md-10">
            <div class="row">
                <div class="col">
                    <p>Imagen de cabecera</p>
                    <img class="{{$classPreview}} image-double-selector-preview1" height="{{$height1}}" width="{{$width1}}" resFactor="{{ $resFactor1 ?? 1 }}" minResFactor="{{ $minResFactor1 ?? 1 }}" maxResFactor="{{ $maxResFactor1 ?? 1 }}" src="{{$src1 ?? 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs='}}" id="image-double-selector-preview1-{{$id}}">
                </div>
                <div class="col">
                    <p>Imagen de tarjeta</p>
                    <img class="{{$classPreview}} image-double-selector-preview2" height="{{$height2}}" width="{{$width2}}" resFactor="{{ $resFactor2 ?? 1 }}" minResFactor="{{ $minResFactor2 ?? 1 }}" maxResFactor="{{ $maxResFactor2 ?? 1 }}" src="{{$src2 ?? 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs='}}" id="image-double-selector-preview2-{{$id}}">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade image-double-selector-modal" id="image-double-selector-modal-{{$id}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <h2>Imagen de cabecera</h2>
                            <div class="img-container img-thumbnail">
                                <img class="image-double-selector-image1" id="image-double-selector-image1-{{$id}}" src="" style="max-width: 100%; display: block">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h2>Imagen de tarjeta</h2>
                            <div class="img-container img-thumbnail">
                                <img class="image-double-selector-image2" id="image-double-selector-image2-{{$id}}" src="" style="max-width: 100%; display: block">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary image-double-selector-cancel-btn">Cancelar</button>
                    <button type="button" class="btn btn-primary image-double-selector-crop-btn">Seleccionar</button>
                </div>
            </div>
        </div>
    </div>
</div>
