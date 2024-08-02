<?php

namespace App\Domains\Responses\Http\Requests\Frontend\Response;

use App\Http\Requests\AbstractRequest;

/**
 * Class DeleteResponseCommentRequest.
 */
class DeleteResponseCommentRequest extends AbstractRequest
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

        if ($this->user()->id == $this->comment->user->id) {
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
