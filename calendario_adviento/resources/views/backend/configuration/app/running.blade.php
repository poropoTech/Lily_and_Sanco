@extends('backend.layouts.app')

@section('title', __('Funcionamiento'))

@push('after-scripts')
    <script src="{{asset('js/vendor/bootstrap-datepicker/js/locales/bootstrap-datepicker.es.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#app_running_start-date').datepicker({
                language: "es",
                format: 'dd/mm/yyyy'
            });
        });
    </script>
@endpush

@section('content')
    <x-forms.patch :action="route('admin.config.app.running.update')" >
        <x-backend.card noPadding>
            <x-slot name="header">
                @lang('Gestión de funcionamiento')
            </x-slot>

            <x-slot name="body">
                <div class="card">
                    <div class="card-header">
                       @lang('Funcionamiento')
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="app_running_auto-mode">@lang('Automático')</label>
                            <select name="app_running_auto-mode" class="form-control" required>
                                <option value="0" {{ $systemSettings['app.running.auto-mode'] == false ? 'selected' : '' }}>@lang('No')</option>
                                <option value="1" {{ $systemSettings['app.running.auto-mode'] == true ? 'selected' : '' }}>@lang('Sí')</option>
                            </select>
                        </div><!--form-group-->
                        <div class="form-group">
                            <label for="app_running_start-date">@lang('Date')</label>
                            <input type="text" id="app_running_start-date" name="app_running_start-date" class="form-control" value="{{ $systemSettings['app.running.start-date']}}">
                        </div><!--form-group-->
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        @lang('Calendario')
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="app_running_random-calendar">@lang('Aleatorio')</label>
                            <select name="app_running_random-calendar" class="form-control" required>
                                <option value="0" {{ $systemSettings['app.running.random-calendar'] == false ? 'selected' : '' }}>@lang('No')</option>
                                <option value="1" {{ $systemSettings['app.running.random-calendar'] == true ? 'selected' : '' }}>@lang('Sí')</option>
                            </select>
                        </div><!--form-group-->
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        @lang('Modificación del valor del gráfico de Progreso')
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="app_running_progress-mode">@lang('Operador')</label>
                            <select name="app_running_progress-mode" class="form-control" required>
                                <option value="mul" {{ $systemSettings['app.running.progress-mode'] == 'mul' ? 'selected' : '' }}>@lang('Multiplicación')</option>
                                <option value="sum" {{ $systemSettings['app.running.progress-mode'] == 'sum' ? 'selected' : '' }}>@lang('Suma')</option>
                                <option value="abs" {{ $systemSettings['app.running.progress-mode'] == 'abs' ? 'selected' : '' }}>@lang('Valor absoluto')</option>
                            </select>
                        </div><!--form-group-->
                        <div class="form-group">
                            <label for="app_running_progress-value">@lang('Valor numérico')</label>
                            <input type="text" id="app_running_progress-value" name="app_running_progress-value" class="form-control" value="{{ $systemSettings['app.running.progress-value']}}">
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
