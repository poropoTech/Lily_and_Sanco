<?php

namespace App\Domains\Configuration\System\Http\Requests\Backend\App\Notifications;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class IndexNotificationsRequest extends FormRequest
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
