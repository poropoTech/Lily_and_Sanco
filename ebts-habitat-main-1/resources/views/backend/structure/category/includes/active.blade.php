@if ($category->isActive())
    <span class="badge badge-success">@lang('Yes')</span>
@else
    <span class="badge badge-danger">@lang('No')</span>
@endif
