@extends('backend.layouts.app')

@section('title', __('Actualizar Actividad'))

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
    <x-forms.patch :action="route('admin.structure.activity.update', $activity)" enctype="multipart/form-data">
        <x-backend.card noPadding>
            <x-slot name="header">
                @lang('Actualizar Actividad')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.structure.activity.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div class="card">
                    <div class="card-header">
                        @lang('Visibilidad')
                    </div>
                    <div class="row px-4">
                        <div class="form-group col-md-4">
                            <label for="order">@lang('Orden')</label>
                            <input type="number" name="order" class="form-control" placeholder="{{ __('Orden') }}" value="{{ old('order') ?? $activity->order}}" maxlength="3" required />
                        </div><!--form-group-->

                        <div class="form-group col-md-4">
                            <label for="published">@lang('Publicada')</label>
                            <select name="published" class="form-control" required>
                                <option value="0" {{ $activity->published == false ? 'selected' : '' }}>@lang('No')</option>
                                <option value="1" {{ $activity->published == true ? 'selected' : '' }}>@lang('Sí')</option>
                            </select>
                        </div><!--form-group-->

                        <div class="form-group col-md-4">
                            <label for="active">@lang('Activa')</label>
                            <select name="active" class="form-control" required>
                                <option value="0" {{ $activity->active == false ? 'selected' : '' }}>@lang('No')</option>
                                <option value="1" {{ $activity->active == true ? 'selected' : '' }}>@lang('Sí')</option>
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
                                @if(config('boilerplate.locale.status') && count(config('boilerplate.locale.languages')) > 1)
                                    <div class="c-header-nav-item dropdown">
                                        <x-utils.link
                                            class="c-header-nav-link fi fi-{{(app()->getLocale() ==='en') ? 'gb' : app()->getLocale()}}"
                                            id="navbarDropdownLanguageLink"
                                            data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false" />

                                        @include('includes.partials.lang')
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category_id" class="col-md-2 col-form-label">@lang('Categoría')</label>
                            <div class="col-md-10">
                                <select name="category_id" class="form-control" required>
                                    @foreach($categories as $category)
                                        @if(old('category_id'))
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                                        @else
                                            <option value="{{ $category->id }}" {{ $activity->category_id == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div><!--form-group-->

                        <div class="form-group row">
                            <label for="title" class="col-md-2 col-form-label">@lang('Título')</label>
                            <div class="col-md-10">
                                <input type="text"  name="title" class="form-control" placeholder="{{ __('Título') }}" value="{{ old('title') ?? $activity->title }}" maxlength="100" required />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-2 col-form-label">@lang('Imagen')</label>
                            <div class="col-md-10">
                                <x-forms.img-double-selector classBrowseBtn="btn btn-sm btn-primary mr-3 align-top"
                                                             classDeleteBtn="btn btn-sm btn-danger mr-3 align-top"
                                                             classPreview="border-dark"  id="1"
                                                             name1="image_header" src1="{{ old('image_header') ?? $activity->imageHeaderURL }}" width1="320" height1="98" resFactor1="8" minResFactor1="5" maxResFactor1="50"
                                                             name2="image_card" src2="{{ old('image_card') ?? $activity->imageCardURL }}" width2="160" height2="120" resFactor2="5" minResFactor2="3" maxResFactor2="50">
                                </x-forms.img-double-selector>
                            </div>
                        </div><!--form-group-->

                        <div class="form-group row">
                            <label for="card_content" class="col-md-2 col-form-label">@lang('Entradilla')</label>
                            <div class="col-md-10">
                                <textarea class="form-control tinymce" data-content-id="{{  $activity->id }}" data-content-type="activity" name="card_content"  placeholder="@lang('Entradilla')">{{ old('card_content') ?? $activity->card_content }}</textarea>
                            </div>
                        </div><!--form-group-->

                        <div class="form-group row">
                            <label for="intro_content" class="col-md-2 col-form-label">@lang('Introducción')</label>
                            <div class="col-md-10">
                                <textarea class="form-control tinymce" data-content-id="{{  $activity->id }}" data-content-type="activity" name="intro_content"  placeholder="@lang('Introducción')">{{ old('intro_content') ?? $activity->intro_content }}</textarea>
                            </div>
                        </div><!--form-group-->

                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        @lang('Desafío individual')
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="individual_type_id" class="col-md-2 col-form-label">@lang('Tipo')</label>
                            <div class="col-md-10">
                                <select name="individual_type_id" class="form-control" required>
                                    @foreach($responseTypes as $type)
                                        @if(old('individual_type_id'))
                                            <option value="{{ $type['id'] }}" {{ old('individual_type_id') == $type['id'] ? 'selected' : ''}}>{{ $type['name'] }}</option>
                                        @else
                                            <option value="{{ $type['id'] }}" {{ $activity->individual_type_id == $type['id'] ? 'selected' : ''}}>{{ $type['name'] }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div><!--form-group-->
                        <div class="form-group row">
                            <label for="individual_content" class="col-md-2 col-form-label">@lang('Contenido')</label>
                            <div class="col-md-10">
                                <textarea class="form-control tinymce" data-content-id="{{  $activity->id }}" data-content-type="activity" name="individual_content"  placeholder="Contenido">{{ old('individual_content') ?? $activity->individual_content }}</textarea>
                            </div>
                        </div><!--form-group-->
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        @lang('Desafío colectivo')
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="collective_type_id" class="col-md-2 col-form-label">@lang('Tipo')</label>
                            <div class="col-md-10">
                                <select name="collective_type_id" class="form-control" required>
                                    @foreach($responseTypes as $type)
                                        @if(old('collective_type_id'))
                                            <option value="{{ $type['id'] }}" {{ old('collective_type_id') == $type['id'] ? 'selected' : ''}}>{{ $type['name'] }}</option>
                                        @else
                                            <option value="{{ $type['id'] }}" {{ $activity->collective_type_id == $type['id'] ? 'selected' : ''}}>{{ $type['name'] }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div><!--form-group-->
                        <div class="form-group row">
                            <label for="collective_content" class="col-md-2 col-form-label">@lang('Contenido')</label>
                            <div class="col-md-10">
                                <textarea class="form-control tinymce" data-content-id="{{  $activity->id }}" data-content-type="activity" name="collective_content"  placeholder="Contenido">{{ old('collective_content') ?? $activity->collective_content }}</textarea>
                            </div>
                        </div><!--form-group-->
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Actualizar Actividad')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
@endsection
