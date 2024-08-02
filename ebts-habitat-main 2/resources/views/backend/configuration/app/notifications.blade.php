@extends('backend.layouts.app')

@section('title', __('Notificaciones'))

@push('after-scripts')
    <script src="{{asset('js/vendor/jqcron/jqCron.js')}}"></script>
    <script src="{{asset('js/vendor/jqcron/jqCron.es.js')}}"></script>
    <script>
        $(document).ready(function() {
            //El siguiente codigo es necesario para que el plugin jqcron pueda funcionar desde la
            //versión 3.5 de JQuery
            var rxhtmlTag = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([a-z][^\/\0>\x20\t\r\n\f]*)[^>]*)\/>/gi;
            jQuery.htmlPrefilter = function( html ) {
                return html.replace( rxhtmlTag, "<$1></$2>" );
            };

            $('.input-cron').jqCron({
                no_reset_button: false,
                lang: 'es'
            });
        });
    </script>
@endpush

@section('content')
    <x-forms.patch :action="route('admin.config.app.notifications.update')" >
        <x-backend.card noPadding>
            <x-slot name="header">
                @lang('Gestión de notificaciones')
            </x-slot>

            <x-slot name="body">
                <div class="card">
                    <div class="card-header">
                       @lang('Notificación por publicación de desafíos')
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="app_notifications_activity-published">@lang('Activadas')</label>
                            <select name="app_notifications_activity-published" class="form-control" required>
                                <option value="0" {{ $systemSettings['app.notifications.activity-published'] == false ? 'selected' : '' }}>@lang('No')</option>
                                <option value="1" {{ $systemSettings['app.notifications.activity-published'] == true ? 'selected' : '' }}>@lang('Sí')</option>
                            </select>
                        </div><!--form-group-->
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        @lang('Notificación por comentario a desafíos')
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="app_notifications_new-response-comment">@lang('Activadas')</label>
                            <select name="app_notifications_new-response-comment" class="form-control" required>
                                <option value="0" {{ $systemSettings['app.notifications.new-response-comment'] == false ? 'selected' : '' }}>@lang('No')</option>
                                <option value="1" {{ $systemSettings['app.notifications.new-response-comment'] == true ? 'selected' : '' }}>@lang('Sí')</option>
                            </select>
                        </div><!--form-group-->
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        @lang('Notificación de recordatorio de desafíos incompletos')
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="app_notifications_incomplete-activities">@lang('Activadas')</label>
                            <select name="app_notifications_incomplete-activities" class="form-control" required>
                                <option value="0" {{ $systemSettings['app.notifications.incomplete-activities'] == false ? 'selected' : '' }}>@lang('No')</option>
                                <option value="1" {{ $systemSettings['app.notifications.incomplete-activities'] == true ? 'selected' : '' }}>@lang('Sí')</option>
                            </select>
                        </div><!--form-group-->
                        <div class="form-group">
                            <label class="d-block" for="app_notifications_incomplete-activities-cron">@lang('Frecuencia')</label>
                            <input class="form-control input-cron d-none" name="app_notifications_incomplete-activities-cron" value="{{$systemSettings['app.notifications.incomplete-activities-cron']}}"/>
                        </div><!--form-group-->
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Actualizar configuración')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
@endsection
