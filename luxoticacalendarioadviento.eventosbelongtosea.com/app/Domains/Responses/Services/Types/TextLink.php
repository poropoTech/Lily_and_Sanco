<?php

namespace App\Domains\Responses\Services\Types;

use App\Domains\Responses\Models\Response;
use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\DB;

class TextLink
{
    public function store(array $data)
    {
        DB::beginTransaction();

        try {
            $dataModel = [
                'activity_id' => $data['activity_id'],
                'type_id' => Response::TYPE_T_LINK,
                'challenge' => $data['challenge'],
                'user_id' => $data['user_id'],
                'content' => $data['content'],
                'ext_content_type' => 'link',
                'ext_content' => $data['link_url'],
            ];

            if (getSysSetting('app.responses.verification-required')) {
                $dataModel['published'] = false;
            }

            $response = Response::create($dataModel);

        } catch (\Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('Hubo un problema creando la respuesta.'));
        }

        DB::commit();

        return $response;
    }
}
