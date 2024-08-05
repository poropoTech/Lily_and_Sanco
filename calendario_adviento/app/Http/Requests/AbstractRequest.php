<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class AbstractRequest extends FormRequest
{
    protected $boundedModels = [];
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

//    public function failedValidation(Validator $validator) {
//        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
//    }

    protected function bindModelById($modelClass, $paramName, $modelId)
    {
        if (! is_null($modelId)) {
            $this->boundedModels[$paramName] = $modelClass::where('id', $modelId)->first();
        }
    }

    public function getBoundedModel($paramName)
    {
        if (array_key_exists($paramName, $this->boundedModels)) {
            return $this->boundedModels[$paramName];
        }

        return null;
    }
}
