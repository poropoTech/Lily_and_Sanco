<?php

namespace App\Domains\Configuration\System\Http\Controllers\Backend\App;

use App\Domains\Configuration\System\Http\Requests\Backend\App\Running\IndexRunningRequest;
use App\Domains\Configuration\System\Http\Requests\Backend\App\Running\UpdateRunningRequest;
use App\Domains\Configuration\System\Services\SystemConfigurationService;

/**
 * Class RunningConfigController.
 */
class RunningConfigController
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

    public function index(IndexRunningRequest $request)
    {
        $settings = [
            'app.running.auto-mode',
            'app.running.start-date',
            'app.running.random-calendar',
            'app.running.progress-mode',
            'app.running.progress-value',
            ];


        return view('backend.configuration.app.running')
            ->withSystemSettings($this->systemConfigService->getConfigSettings($settings));
    }

    public function update(UpdateRunningRequest $request)
    {
        $this->systemConfigService->setConfigSetting($request->validated());

        return redirect()->back()->withFlashSuccess(__('La configuración ha sido modificada.'));
    }
}
