<?php

namespace App\Domains\Configuration\System\Http\Controllers\Backend\App;

use App\Domains\Configuration\System\Http\Requests\Backend\App\Notifications\IndexNotificationsRequest;
use App\Domains\Configuration\System\Http\Requests\Backend\App\Notifications\UpdateNotificationsRequest;
use App\Domains\Configuration\System\Services\SystemConfigurationService;

/**
 * Class NotificationsConfigController.
 */
class NotificationsConfigController
{
    /**
     * @var SystemConfigurationService
     */
    protected $systemConfigService;

    /**
     * NotificationsConfigController constructor.
     *
     * @param  SystemConfigurationService  $systemConfigService
     */
    public function __construct(SystemConfigurationService $systemConfigService)
    {
        $this->systemConfigService = $systemConfigService;
    }

    public function index(IndexNotificationsRequest $request)
    {
        $settings = [
            'app.notifications.activity-published',
            'app.notifications.incomplete-activities',
            'app.notifications.incomplete-activities-cron',
            'app.notifications.new-response-comment',
            ];


        return view('backend.configuration.app.notifications')
            ->withSystemSettings($this->systemConfigService->getConfigSettings($settings));
    }

    public function update(UpdateNotificationsRequest $request)
    {
        $this->systemConfigService->setConfigSetting($request->validated());

        return redirect()->back()->withFlashSuccess(__('La configuración ha sido modificada.'));
    }
}
