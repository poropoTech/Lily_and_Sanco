<?php

namespace App\Domains\Configuration\System\Http\Controllers\Backend\System;

use App\Domains\Configuration\System\Http\Requests\Backend\System\Styles\IndexStylesRequest;
use App\Domains\Configuration\System\Http\Requests\Backend\System\Styles\UpdateStylesRequest;
use App\Domains\Configuration\System\Services\SystemConfigurationService;

/**
 * Class StylesConfigController.
 */
class StylesConfigController
{
    /**
     * @var SystemConfigurationService
     */
    protected $systemConfigService;

    /**
     * StylesConfigController constructor.
     *
     * @param  SystemConfigurationService  $systemConfigService
     */
    public function __construct(SystemConfigurationService $systemConfigService)
    {
        $this->systemConfigService = $systemConfigService;
    }

    public function index(IndexStylesRequest $request)
    {
        $settings = [
            'system.design.frontend',
            'system.design.backend',
            ];


        return view('backend.configuration.system.styles')
            ->withSystemSettings($this->systemConfigService->getConfigSettings($settings));
    }

    public function update(UpdateStylesRequest $request)
    {
        $this->systemConfigService->setConfigSetting($request->validated());

        return redirect()->back()->withFlashSuccess(__('La configuración ha sido modificada.'));
    }
}
