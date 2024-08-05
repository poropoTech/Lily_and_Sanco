<?php

namespace App\Domains\Responses\Services\Types;

use App\Domains\Responses\Models\Response;
use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\DB;

class TextVideo
{
    public function store(array $data)
    {
        DB::beginTransaction();

        try {
            $dataModel = [
                'activity_id' => $data['activity_id'],
                'type_id' => Response::TYPE_T_V,
                'challenge' => $data['challenge'],
                'user_id' => $data['user_id'],
                'content' => $data['content'],
            ];

            $video = $this->getVideoByUrl($data['video_url']);

            $dataModel['ext_content'] = $video['videoId'];
            $dataModel['ext_content_type'] = $video['provider'];

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


    protected function getVideoByUrl($url)
    {
        if ($videoId = $this->checkYoutube($url)) {
            return ['provider' => 'Youtube', 'videoId' => $videoId];
        }

        if ($videoId = $this->checkVimeo($url)) {
            return ['provider' => 'Vimeo', 'videoId' => $videoId];
        }

        throw new GeneralException(__('El proveedor de video externo no es válido.'));
    }

    protected function checkYoutube($url)
    {
        preg_match(
            "/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/",
            $url,
            $matches
        );

        if (array_key_exists(1, $matches)) {
            return $matches[1];
        }

        return null;
    }

    protected function checkVimeo($url)
    {
        preg_match('%^https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\#?)(?:[?]?.*)$%im', $url, $matches);

        if (array_key_exists(3, $matches)) {
            return $matches[3];
        }

        return null;
    }
}
