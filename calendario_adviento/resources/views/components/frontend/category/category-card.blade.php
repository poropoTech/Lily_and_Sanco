<div class="category-card d-inline-block {{ $category->isActive() ? '' : 'category-card-disabled' }}">
    <div class="category-card-icon-container">
        @if($newActivities['newActivities'])
            <span class="badge">
                {{ $newActivities['newActivities'] }}
                @if($newActivities['newActivities'] > 1)
                    @lang('components_frontend.category.card.new_challenges')
                @else
                    @lang('components_frontend.category.card.new_challenge')
                @endif
            </span>
        @endif
    </div>
    <div class="">
        <a class="category-card-link" href="{{ $category->uniqueActivityId ? route('frontend.pages.activity', ['activity' => $category->uniqueActivityId]) : route('frontend.pages.category', ['category' => $category->id]) }}">
            <img class="category-card-image grow" src="{{$category->iconURL }}"/>

        </a>
    </div>
{{--    <h5 class="category-card-name">{{ $category->name }}</h5>--}}
{{--    <div class="category-card-description">{{ $category->description }}</div>--}}
</div>
