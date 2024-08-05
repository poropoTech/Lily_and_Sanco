@php
    switch ($challenge) {
        case 'individual':
            $cardClass = 'activity-response-btn-card-individual';
             break;
        case 'collective':
           $cardClass = 'activity-response-btn-card-collective';
           break;
        default:
          $cardClass = '';
    }

    if($activity->isActive()) {
       if(! $activity->isChallengeDone(auth()->user(), $challenge)){
           $btnClass = 'activity-response-btn-todo grow ';
           $btnDisabled = '';
           switch ($challenge) {
               case 'individual':
                   $btnImage = '<img class="activity-response-btn-image" src="'. asset('img/pages/activity/individual-challenge-btn.svg') .'"/>';
                   $btnText = __('components_frontend.activity.response-btn.do_individual_challenge');
                   break;
               case 'collective':
                   $btnImage = '<img class="activity-response-btn-image" src="'. asset('img/pages/activity/collective-challenge-btn.svg') .'"/>';
                   $btnText = __('components_frontend.activity.response-btn.do_collective_challenge');
                   break;
               default:
                   $btnText = __('Type not found');
           }
       }else{
           $btnClass = 'disabled activity-response-btn-done';
           $btnImage = '<i class="far fa-4x fa-check-circle text-primary"></i>';
           $btnText = __('components_frontend.activity.response-btn.challenge_done');
           $btnDisabled = 'disabled';
       }
    } else {
       $btnClass = 'disabled activity-response-btn-disabled';
       $btnImage = '<i class="far fa-4x fa-times-circle text-primary"></i>';
       $btnText = __('components_frontend.activity.response-btn.challenge_inactive');
       $btnDisabled = 'disabled';
    }
@endphp

<div class="activity-response-btn-card {{ $cardClass }}">
    <div class="activity-response-btn {{ $btnClass }}"
         data-response-new-modal-id="{{ $activity->id }}"
         data-response-new-url="{{ route('frontend.activities.new_response', ['activity' => $activity->id, 'challenge' => $challenge])}}"
         data-response-new-modal-counter="#activity-responses-counter-{{ $activity->id }}"
        {{ $btnDisabled }}>
        {!! $btnImage !!}
        <h5 class="activity-response-btn-text">{!! $btnText !!}</h5>
    </div>
</div>

