@extends('backend.layouts.app')

@section('title', __('CSS'))


@section('content')
    <x-forms.patch :action="route('admin.config.sys.styles.update')" >
        <x-backend.card noPadding>
            <x-slot name="header">
                @lang('Gestión de Estilos')
            </x-slot>

            <x-slot name="body">
                <div class="card">
                    <div class="card-header">
                        @lang('Estilo para el Frontend')
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="system_design_frontend" class="col-md-2 col-form-label">@lang('CSS')</label>
                            <div class="col-md-10">
                                <textarea class="form-control" rows="15" name="system_design_frontend" >{{ old('system_design_frontend') ?? $systemSettings['system.design.frontend'] }}</textarea>
                            </div>
                        </div><!--form-group-->
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        @lang('Estilo para el Backend')
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="system_design_backend" class="col-md-2 col-form-label">@lang('CSS')</label>
                            <div class="col-md-10">
                                <textarea class="form-control" rows="15" name="system_design_backend" >{{ old('system_design_backend') ?? $systemSettings['system.design.backend'] }}</textarea>
                            </div>
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
