<div class="row activity-card-info-bar">
    <div class="col-md-12">
        @if($activity->isViewed($logged_in_user))
            <span><i class="fas fa-2x fa-eye activity-card-info-bar-item"></i></span>
        @else
            <span><i class="fas fa-eye activity-card-info-bar-item text-muted"></i></span>
        @endif
        @if($activity->isIndividualChallengeDone($logged_in_user))
            <span><i class="fas fa-2x fa-user activity-card-info-bar-item"></i></span>
        @else
            <span><i class="fas fa-user activity-card-info-bar-item text-muted"></i></span>
        @endif
        @if($activity->isCollectiveChallengeDone($logged_in_user))
            <span><i class="fas fa-2x fa-users activity-card-info-bar-item"></i></span>
        @else
            <span><i class="fas fa-users activity-card-info-bar-item text-muted"></i></span>
        @endif

        @if($activity->isNew($logged_in_user->last_session_at))
                <span class="badge mx-4">@lang('Desafío nuevo')</span>
        @endif
    </div>
</div>
