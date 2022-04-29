<?php

namespace Darkink\AuthorizationServerUI\Http\Requests\Group;

use Darkink\AuthorizationServer\Http\Requests\Evaluator\EvaluatorRequestResponseMode;
use Darkink\AuthorizationServer\Rules\IsClient;
use Darkink\AuthorizationServer\Rules\IsUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class PermissionGroupRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'permissions' => ['array'],
        ];
    }

    // public function validatedAsModel()
    // {
    //     $result = $this->validator->validated();
    //     $result['client'] =
    //     return $result;
    // }

}
