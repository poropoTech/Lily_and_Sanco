
@extends('backend.layouts.app')

@section('title', __('Crear Categoría'))

@push('after-scripts')
    <script>
        tinymce.init({
            height: 500,
            selector: '.tinymce',
            content_css : '/css/frontend.css',
            language: 'es_ES',
            language_url: '/js/vendor/tinymce/langs/es_ES.js',
            skin: 'oxide',
            skin_url: '/js/vendor/tinymce/skins/ui/oxide/',
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons paste textcolor filemanager code"
            ],
            toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
            toolbar2: "| responsivefilemanager | link unlink | image media | forecolor fontselect fontsizeselect sizeselect| print preview code ",
            image_advtab: true ,
            font_formats: 'Karla=Karla;Recoleta=Recoleta;',
            filemanager_access_key: '@filemanager_get_key()',
            filemanager_sort_by: '',
            filemanager_descending: '',
            filemanager_subfolder: '',
            filemanager_crossdomain: '',
            external_filemanager_path: '/admin/filemanager/dialog.php',
            filemanager_title:"Gestor de ficheros",
            external_plugins: { "filemanager" : "/vendor/responsivefilemanager/plugin.min.js"}
        });
    </script>
@endpush

@section('content')
    <x-forms.post :action="route('admin.structure.category.store')" enctype="multipart/form-data">
        <x-backend.card noPadding>
            <x-slot name="header">
                @lang('Crear Categoría')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.structure.category.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div class="card">
                    <div class="card-header">
                        @lang('Visibilidad')
                    </div>
                    <div class="row px-4">
                        <div class="form-group col-md-4">
                            <label for="order">@lang('Orden')</label>
                            <input type="number" name="order" class="form-control" placeholder="{{ __('Orden') }}" value="{{ old('order') ?? 0}}" maxlength="3" required />
                        </div><!--form-group-->

                        <div class="form-group col-md-4">
                            <label for="published">@lang('Publicada')</label>
                            <select name="published" class="form-control" required>
                                <option value="0" {{ old('published') == 0 ? 'selected' : ''}}>@lang('No')</option>
                                <option value="1" {{ old('published') == 1 ? 'selected' : ''}}>@lang('Sí')</option>
                            </select>
                        </div><!--form-group-->

                        <div class="form-group col-md-4">
                            <label for="active">@lang('Activa')</label>
                            <select name="active" class="form-control" required>
                                <option value="0" {{ old('active') == 0 ? 'selected' : ''}}>@lang('No')</option>
                                <option value="1" {{ old('active') == 1 ? 'selected' : ''}}>@lang('Sí')</option>
                            </select>
                        </div><!--form-group-->
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        @lang('General')
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="language" class="col-md-2 col-form-label">@lang('Idioma')</label>
                            <div class="col-md-10">
                                <span class="fi fi-{{config('boilerplate.locale.language')}}"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="icon" class="col-md-2 col-form-label">@lang('Icono')</label>
                            <div class="col-md-10">
                                <x-forms.img-selector classBrowseBtn="btn btn-sm btn-primary mr-3 align-top"
                                                       classDeleteBtn="btn btn-sm btn-danger mr-3 align-top"
                                                       classPreview="border-dark"
                                                       id="1" name="icon" width="100" height="100"
                                                       resFactor="4" minResFactor="3" maxResFactor="50">
                                </x-forms.img-selector>
                            </div>
                        </div><!--form-group-->

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>
                            <div class="col-md-10">
                                <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') }}" maxlength="100" required />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-2 col-form-label">@lang('Descripción')</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="description" rows="3" placeholder="Descripción">{{ old('description') }}</textarea>
                            </div>
                        </div><!--form-group-->

                        <div class="form-group row">
                            <label for="image" class="col-md-2 col-form-label">@lang('Imagen')</label>
                            <div class="col-md-10">
                                <x-forms.img-selector classBrowseBtn="btn btn-sm btn-primary mr-3 align-top"
                                                       classDeleteBtn="btn btn-sm btn-danger mr-3 align-top"
                                                       classPreview="border-dark"
                                                       id="2" name="image" width="320" height="98" resFactor="8" minResFactor="5" maxResFactor="50">
                                </x-forms.img-selector>
                            </div>
                        </div><!--form-group-->

                        <div class="form-group row">
                            <label for="content" class="col-md-2 col-form-label">@lang('Contenido')</label>
                            <div class="col-md-10">
                                <textarea class="form-control tinymce"  name="content" rows="15" placeholder="Contenido">{{ old('content') }}</textarea>
                            </div>
                        </div><!--form-group-->
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Crear Categoría')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
