<?php

namespace App\Domains\Structure\Http\Requests\Frontend\Activity;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class GetResponseFeedRequest.
 */
class GetResponseFeedRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'page' => ['required', 'integer', 'min:1'],
        ];
    }
}
