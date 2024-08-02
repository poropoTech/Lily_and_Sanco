@inject('model','\App\Domains\Responses\Models\Response')

<div id="response-card-id-{{ $response->id }}" class="response-card {{ $response->user_id == $logged_in_user->id ? 'response-card-self' : '' }}" data-response-id="{{ $response->id }}">
    <div class="">
        <div class="d-flex align-items-center response-card-author">
            <div class="p-2">
                <img class="response-card-author-image" src="{{ $response->user->avatar }}"/>
            </div>
            <div class="p-0">
                <span class="response-card-author-alias">{{ $response->user->alias }}</span>
            </div>
            <div class="p-2 ml-auto">
                <a href="{{route('frontend.pages.activity', ['activity' => $response->activity->id])}}">
                    <img class="response-card-category-icon" src="{{ $response->activity->category->iconURL }}"/>
                </a>
            </div>
        </div>
        <div class="response-card-image-container">
            <div class="">
                @switch($response->type_id)
                    @case($model::TYPE_CLICK)
                        @include('components.frontend.response.types.click-renderer')
                        @break
                    @case($model::TYPE_T)
                        @include('components.frontend.response.types.text-renderer')
                        @break
                    @case($model::TYPE_T_PDF)
                        @include('components.frontend.response.types.text-pdf-renderer')
                        @break
                    @case($model::TYPE_T_I)
                        @include('components.frontend.response.types.text-image-renderer')
                        @break
                    @case($model::TYPE_T_V)
                        @include('components.frontend.response.types.text-video-renderer')
                        @break
                    @case($model::TYPE_T_LINK)
                        @include('components.frontend.response.types.text-link-renderer')
                        @break
                    @case($model::TYPE_T_OI)
                        @include('components.frontend.response.types.text-optional-image-renderer')
                    @break
                @endswitch
            </div>
        </div>
        <div class="response-card-actions">
            <div class="py-1 d-flex">
                <div>
                    <x-frontend.response.response-like :response="$response"/>
                </div>
                <div class="d-flex ml-auto">
                    <div class="ml-3">
                        <x-frontend.response.response-delete :response="$response"/>
                    </div>
                    <div class="ml-3">
                        <x-frontend.response.response-publish :response="$response"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="response-card-text">
            <div class="response-card-text-bar pb-1">
                <span class="response-card-text-author font-weight-bold">
                    {{$response->user->alias.': '}}
                </span>
                <span class="response-card-text-author">
                    {{$response->content}}
                </span>
                <span><i> Hace {{ \Carbon\Carbon::now()->diffForHumans($response->created_at, \Carbon\CarbonInterface::DIFF_ABSOLUTE)}}.</i></span>
            </div>

            <div class="response-card-text-like font-weight-bold">
                Le gusta a <span class="response-card-like-counter">{{ $response->likes()->count() }}</span> personas.
            </div>
            <div class="response-card-text-comments font-weight-bold">
                <a ref="#" role="button" class="response-card-comment-btn ">Ver los <span class="response-card-comment-counter">{{ $response->comments()->onlyPublished()->count() }}</span> comentarios.</a>
            </div>
            <div class="response-card-response-bar">
                <x-frontend.response.response-comment-inline :response="$response"/>
            </div>
        </div>
        <x-frontend.response.response-comment :response="$response"/>
    </div>
</div>
