<div class="activity-card {{ $activity->isActive() ? '' : 'activity-card-disabled' }}">
    <div class="row">
        <div class="col-md-6 order-2 order-md-1 activity-card-main">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="activity-card-title">{{ $activity->title }}</h5>
                    <div class="activity-card-content">{!! $activity->card_content !!} </div>
                </div>
            </div>

            <div class="row activity-card-response-bar">
                <div class="col-md-12">
                    @php
                        if($activity->isActive()) {
                            $btnClass = 'activity-card-response-btn-todo';
                            if(! $activity->isDone($logged_in_user)){
                                $btnText = __('¡Ver el desafío!');
                            }else{
                                $btnText = __('¡Desafío conseguido!');
                            }
                        } else {
                            $btnClass = 'disabled activity-card-response-btn-disabled';
                            $btnText = __('Desafío no activo');
                        }
                    @endphp
                    <a class="btn btn-primary btn-sm {{$btnClass}}" href="{{ route('frontend.pages.activity', ['activity' => $activity->id]) }}">{{$btnText}}</a>
                </div>
            </div>
{{--            <div class="row activity-card-action-bar">--}}
{{--                <div class="col-md-12">--}}
{{--                    <button class="btn btn-outline-dark btn-sm activity-card-response-btn" x-data="{{ $activity->id }}">Otra acción</button>--}}
{{--                </div>--}}
{{--            </div>--}}
            <x-frontend.activity.activity-card-info-bar :activity="$activity"/>
            @if($logged_in_user->can('admin.access.structure.activity'))
                <x-frontend.activity.activity-card-admin-bar :activity="$activity"/>
            @endif
        </div>

        <div class="col-md-6 order-1 order-md-2 text-center text-md-right">
            <img class="activity-card-image" src="{{$activity->imageCardURL }}"/>
        </div>
    </div>
    @if(isset($separator))
        <div class="row">
            <div class="col-12">
                <div class="activity-card-separator"></div>
            </div>
        </div>
    @endif
</div>

