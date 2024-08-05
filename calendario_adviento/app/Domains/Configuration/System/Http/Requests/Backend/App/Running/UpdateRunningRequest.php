<?php

namespace App\Domains\Configuration\System\Http\Requests\Backend\App\Running;

use App\Domains\Common\Rules\CronExpression;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRunningRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'app_running_auto-mode' => ['required', 'boolean'],
            'app_running_start-date' => ['required'],
            'app_running_random-calendar' => ['required', 'boolean'],
            'app_running_progress-mode' => ['required', 'in:mul,sum,abs'],
            'app_running_progress-value' => ['required', 'numeric'],
        ];
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException(__('No tienes privilegios suficientes'));
    }
}
