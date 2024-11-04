<?php

namespace App\Domains\Configuration\System\Http\Requests\Backend\App\Notifications;

use App\Domains\Common\Rules\CronExpression;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNotificationsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'app_notifications_activity-published' => ['required', 'boolean'],
            'app_notifications_incomplete-activities' => ['required', 'boolean'],
            'app_notifications_incomplete-activities-cron' => ['required', new CronExpression()],
            'app_notifications_new-response-comment' => ['required', 'boolean'],
        ];
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException(__('No tienes privilegios suficientes'));
    }
}
