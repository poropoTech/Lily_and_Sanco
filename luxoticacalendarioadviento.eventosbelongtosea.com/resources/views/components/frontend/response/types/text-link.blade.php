@inject('model','\App\Domains\Responses\Models\Response')

@extends('components.frontend.response.response-new-modal')

@section('content')
<input type="hidden" name="challenge" value="{{$challenge}}">
<input type="hidden" name="type_id" value="{{$model::TYPE_T_LINK}}">

<div id="response-new-modal-accordion">
    <div class="card">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <button type="button" class="btn btn-link shadow-none" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    @lang('components_frontend.response.types.write_text')
                </button>
            </h5>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#response-new-modal-accordion">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-12">
                        <textarea class="form-control emoji-text-input"  name="content" rows="3" placeholder="@lang('components_frontend.response.types.messaje_placeholder')"></textarea>
                    </div>
                </div><!--form-group-->
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
                <button type="button" class="btn btn-link shadow-none collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    @lang('components_frontend.response.types.link_page')
                </button>
            </h5>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#response-new-modal-accordion">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-12">
                        <input type="text" name="link_url" class="form-control" required/>
                    </div>
                </div><!--form-group-->
            </div>
        </div>
    </div>
</div>
@endsection