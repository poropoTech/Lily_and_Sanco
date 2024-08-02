@inject('model','\App\Domains\Responses\Models\Response')

@extends('components.frontend.response.response-new-modal')

@section('content')
    <input type="hidden" name="challenge" value="{{$challenge}}">
    <input type="hidden" name="type_id" value="{{$model::TYPE_CLICK}}">

    <div class="response-new-modal-autosubmit">
    </div>
@endsection
