<?php

namespace App\Domains\Configuration\System\Http\Requests\Backend\System\Styles;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class IndexStylesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [];
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException(__('No tienes privilegios suficientes'));
    }
}
