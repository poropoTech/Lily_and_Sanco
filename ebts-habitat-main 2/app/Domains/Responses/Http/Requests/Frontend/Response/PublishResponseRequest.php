<?php

namespace App\Domains\Responses\Http\Requests\Frontend\Response;

use App\Http\Requests\AbstractRequest;

/**
 * Class PublishResponseRequest.
 */
class PublishResponseRequest extends AbstractRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user()->isAdmin()) {
            return true;
        }

        return false;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
