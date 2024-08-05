<div class="row">
    <div class="col-md-6 text-left">
        @lang('frontend_pages_main.sections.purposes.text')
    </div>
</div>

<div class="row">
    <div class="col-md-12 text-center justify-content-center">
        @foreach($categories as $category)
            <x-frontend.category.category-card :category="$category" :newActivities="$newActivities[$category->id]"/>
        @endforeach
    </div>
</div>
