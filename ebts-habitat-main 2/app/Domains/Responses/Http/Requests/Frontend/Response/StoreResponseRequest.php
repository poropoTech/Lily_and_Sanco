<?php

namespace App\Domains\Responses\Http\Requests\Frontend\Response;

use App\Domains\Responses\Models\Response;
use App\Domains\Responses\Rules\ExternalVideoProvider;
use App\Domains\Structure\Models\Activity;
use App\Http\Requests\AbstractRequest;

/**
 * Class StoreResponseRequest.
 */
class StoreResponseRequest extends AbstractRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (! $activity = $this->getBoundedModel('activity_id')) {
            return false;
        }

        if (! $this->challenge) {
            return false;
        }

        return $activity->canUserCreateResponse($this->user(), $this->challenge);
    }

    protected function prepareForValidation()
    {
        $this->bindModelById(Activity::class, 'activity_id', $this->input('activity_id'));
        $this->challenge = $this->input('challenge', false);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->getRulesForType();
    }

    /**
     * @return array
     */
    public function messages()
    {
        return $this->getMessagesForType();
    }

    protected function getRulesForType()
    {
        $activity = $this->getBoundedModel('activity_id');

        switch ($activity->getResponseTypeByChallenge($this->challenge)) {
            case Response::TYPE_CLICK:
                return [
                    'activity_id' => ['required', 'exists:activities,id'],
                    'type_id' => ['required', 'in:'.Response::TYPE_CLICK],
                    'challenge' => ['required', 'in:'.$this->challenge],
                ];
            case Response::TYPE_T:
                return [
                    'activity_id' => ['required', 'exists:activities,id'],
                    'type_id' => ['required', 'in:'.Response::TYPE_T],
                    'challenge' => ['required', 'in:'.$this->challenge],
                    'content' => ['required', 'min:1', 'max:300'],
                ];
                break;
            case Response::TYPE_T_PDF:
                return [
                    'activity_id' => ['required', 'exists:activities,id'],
                    'type_id' => ['required', 'in:'.Response::TYPE_T_PDF],
                    'challenge' => ['required', 'in:'.$this->challenge],
                    'content' => ['required', 'min:1', 'max:300'],
                    'pdf' => ['required', 'mimes:pdf'],
                ];
                break;
            case Response::TYPE_T_I:
                return [
                    'activity_id' => ['required', 'exists:activities,id'],
                    'type_id' => ['required', 'in:'.Response::TYPE_T_I],
                    'challenge' => ['required', 'in:'.$this->challenge],
                    'content' => ['required', 'min:1', 'max:300'],
                    'image' => ['required'],
                ];
                break;
            case Response::TYPE_T_V:
                return [
                    'activity_id' => ['required', 'exists:activities,id'],
                    'type_id' => ['required', 'in:'.Response::TYPE_T_V],
                    'challenge' => ['required', 'in:'.$this->challenge],
                    'content' => ['required', 'min:1', 'max:300'],
                    'video_url' => ['required', new ExternalVideoProvider()],
                ];
                break;
            case Response::TYPE_T_LINK:
                return [
                    'activity_id' => ['required', 'exists:activities,id'],
                    'type_id' => ['required', 'in:'.Response::TYPE_T_LINK],
                    'challenge' => ['required', 'in:'.$this->challenge],
                    'content' => ['required', 'min:1', 'max:300'],
                    'link_url' => ['required', 'url'],
                ];
                break;
            case Response::TYPE_T_OI:
                return [
                    'activity_id' => ['required', 'exists:activities,id'],
                    'type_id' => ['required', 'in:'.Response::TYPE_T_OI],
                    'challenge' => ['required', 'in:'.$this->challenge],
                    'content' => ['required', 'min:1', 'max:300'],
                    'image' => ['sometimes'],
                ];
                break;
        }
    }

    protected function getMessagesForType()
    {
        $activity = $this->getBoundedModel('activity_id');

        switch ($activity->getResponseTypeByChallenge($this->challenge)) {
            case Response::TYPE_CLICK:
                return [
                ];
                break;
            case Response::TYPE_T_OI:
            case Response::TYPE_T:
                return [
                    'content.required' => __('Debes introducir un pequeño texto (max. 300 caracteres).'),
                    'content.min' => __('El texto debe tener como mínimo 1 caracter.'),
                    'content.max' => __('El texto debe tener como máximo 300 caracteres.'),
                ];
                break;
            case Response::TYPE_T_PDF:
                return [
                    'content.required' => __('Debes introducir un pequeño texto (max. 300 caracteres).'),
                    'content.min' => __('El texto debe tener como mínimo 1 caracter.'),
                    'content.max' => __('El texto debe tener como máximo 300 caracteres.'),
                    'pdf.required' => __('Debes enviar un pdf.'),
                    'pdf.mimes' => __('Debes enviar un pdf.'),
                ];
                break;
            case Response::TYPE_T_I:
                return [
                    'content.required' => __('Debes introducir un pequeño texto (max. 300 caracteres).'),
                    'content.min' => __('El texto debe tener como mínimo 1 caracter.'),
                    'content.max' => __('El texto debe tener como máximo 300 caracteres.'),
                    'image.required' => __('Debes enviar una imagen.'),
                ];
                break;
            case Response::TYPE_T_V:
                return [
                    'content.required' => __('Debes introducir un pequeño texto (max. 300 caracteres).'),
                    'content.min' => __('El texto debe tener como mínimo 1 caracter.'),
                    'content.max' => __('El texto debe tener como máximo 300 caracteres.'),
                    'video_url.required' => __('Debes enlazar un video (Youtube o Vimeo).'),
                ];
                break;
            case Response::TYPE_T_LINK:
                return [
                    'content.required' => __('Debes introducir un pequeño texto (max. 300 caracteres).'),
                    'content.min' => __('El texto debe tener como mínimo 1 caracter.'),
                    'content.max' => __('El texto debe tener como máximo 300 caracteres.'),
                    'link_url.required' => __('Debes enlazar una página o documento en internet.'),
                ];
                break;
        }
    }
}
