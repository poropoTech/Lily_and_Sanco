<div class="challenges-category-card d-inline-block {{ $category->isActive() ? '' : 'challenges-category-card-disabled' }}">
    <a class="challenges-category-card-link" href="{{ route('frontend.pages.category', ['category' => $category->id]) }}">
        <img class="challenges-category-card-image" src="{{$category->iconURL }}"/>
    </a>
    <h5 class="challenges-category-card-name">{{ $category->name }}</h5>
    <div class="row justify-content-center">
        <div
            data-preset="fan"
            class="ldBar label-center"
            data-value="{{ $stats['totalActivities'] == 0 ? 0 : 100 - $stats['notCompletedRatio'] }}"
            data-stroke-width="10"
        ></div>
    </div>
</div>
