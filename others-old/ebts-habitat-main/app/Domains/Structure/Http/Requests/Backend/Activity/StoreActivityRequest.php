<?php

namespace App\Domains\Structure\Http\Requests\Backend\Activity;

use App\Domains\Structure\Rules\Activity\ResponseTypes;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreRoleRequest.
 */
class StoreActivityRequest extends FormRequest
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
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'min:5', 'max:100'],
            'card_content' => ['required', 'min:5'],
            'intro_content' => ['required', 'min:5'],
            'individual_content' => ['required', 'min:5'],
            'individual_type_id' => ['required', new ResponseTypes()],
            'collective_content' => ['required', 'min:5'],
            'collective_type_id' => ['required', new ResponseTypes()],
            'image_header' => ['required'],
            'image_card' => ['required'],
            'order' => ['required', 'numeric', 'integer'],
            'published' => ['required', 'boolean'],
            'active' => ['required', 'boolean'],
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
        ];
    }
}
