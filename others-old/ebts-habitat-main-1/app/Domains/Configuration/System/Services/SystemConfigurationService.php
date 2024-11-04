<?php

namespace App\Domains\Configuration\System\Services;

use App\Domains\Configuration\System\Models\SystemSetting;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class SystemConfigurationService.
 */
class SystemConfigurationService extends BaseService
{
    /**
     * SystemConfigurationService constructor.
     *
     * @param  SystemSetting  $systemConfiguration
     */
    public function __construct(SystemSetting $systemConfiguration)
    {
        $this->model = $systemConfiguration;
    }


    protected function updateSetting(SystemSetting $systemConfiguration, $data): SystemSetting
    {
        if (is_null($systemConfiguration)) {
            return null;
        }

        try {
            $systemConfiguration->update([
                'value' => $data,
            ]);
        } catch (Exception $e) {
            throw new GeneralException(__('Hubo un problema actualizando el parámetro de configuración.'));
        }

        return $systemConfiguration;
    }

    public function setConfigSetting(array $data = [])
    {
        DB::beginTransaction();

        foreach ($data as $key => $value) {
            try {
                $this->updateSetting(SystemSetting::where('key', str_replace('_', '.', $key))->first(), $value);
            } catch (Exception $e) {
                DB::rollBack();

                throw $e;
            }
        }

        DB::commit();
    }

    public function getConfigSettings(array $settings)
    {
        $systemSettings = SystemSetting::whereIn('key', $settings)->get();

        $retSettings = [];
        foreach ($systemSettings as $key => $value) {
            $retSettings[$value->key] = $value->value;
        }

        return $retSettings;
    }
}
