<?php

namespace App\Domains\Responses\Services;

use App\Domains\Responses\Events\ResponseCreated;
use App\Domains\Responses\Events\ResponseDeleted;
use App\Domains\Responses\Events\ResponsePublished;
use App\Domains\Responses\Events\ResponseUnpublished;
use App\Domains\Responses\Models\Response;
use App\Domains\Responses\Services\Types\Click;
use App\Domains\Responses\Services\Types\Text;
use App\Domains\Responses\Services\Types\TextImage;
use App\Domains\Responses\Services\Types\TextLink;
use App\Domains\Responses\Services\Types\TextOptionalImage;
use App\Domains\Responses\Services\Types\TextPdf;
use App\Domains\Responses\Services\Types\TextVideo;
use App\Exceptions\GeneralException;

/**
 * Class ResponseService.
 */
class ResponseService
{
    public function __construct()
    {
    }

    public function getResponseTypeFormView(int $typeId)
    {
        switch ($typeId) {
            case Response::TYPE_CLICK:
                return 'components.frontend.response.types.click';
            case Response::TYPE_T:
                return 'components.frontend.response.types.text';
            case Response::TYPE_T_PDF:
                return 'components.frontend.response.types.text-pdf';
            case Response::TYPE_T_I:
                return 'components.frontend.response.types.text-image';
            case Response::TYPE_T_V:
                return 'components.frontend.response.types.text-video';
            case Response::TYPE_T_LINK:
                return 'components.frontend.response.types.text-link';
            case Response::TYPE_T_OI:
                return 'components.frontend.response.types.text-optional-image';
            default:
                throw new GeneralException(__('Error en tipo de actividad'));
        }
    }

    public function store(array $data = []): Response
    {
        switch ($data['type_id']) {
            case Response::TYPE_CLICK:
                $writer = new Click();

                break;
            case Response::TYPE_T:
                $writer = new Text();

                break;
            case Response::TYPE_T_PDF:
                $writer = new TextPdf();

                break;
            case Response::TYPE_T_I:
                $writer = new TextImage();

                break;
            case Response::TYPE_T_V:
                $writer = new TextVideo();

                break;
            case Response::TYPE_T_LINK:
                $writer = new TextLink();

                break;
            case Response::TYPE_T_OI:
                $writer = new TextOptionalImage();

                break;
            default:
                throw new GeneralException(__('El tipo de respuesta no es válido.'));
        }

        $response = $writer->store($data);

        event(new ResponseCreated($response));

        return $response;
    }

    public function publish(Response $response): void
    {
        $response->published = true;
        $response->save();

        event(new ResponsePublished($response));
    }

    public function unpublish(Response $response): void
    {
        $response->published = false;
        $response->save();

        event(new ResponseUnpublished($response));
    }


    public function destroy(Response $response): void
    {
        try {
            $response->delete();
        } catch (\Exception $e) {
            throw new GeneralException(__('Error eliminando respuesta.'));
        }

        event(new ResponseDeleted($response));
    }

    public function getTypes(): array
    {
        return Response::TYPES;
    }
}
