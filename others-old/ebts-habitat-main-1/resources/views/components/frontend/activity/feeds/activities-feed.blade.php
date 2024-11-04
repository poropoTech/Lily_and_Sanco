@foreach($activities as $activity)
    <div class="activity-feed-item">
    <x-frontend.activity.activity-card :activity="$activity" separator/>
    </div>
@endforeach
@if(getSysSetting('app.category.wall-activities-per-page') == count($activities))
    <div class="feed-more-items"></div>
@endif
