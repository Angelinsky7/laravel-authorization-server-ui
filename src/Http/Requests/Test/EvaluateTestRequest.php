<?php

namespace Darkink\AuthorizationServerUI\Http\Requests\Test;

use Darkink\AuthorizationServer\Http\Requests\Evaluator\EvaluatorRequestResponseMode;
use Darkink\AuthorizationServer\Rules\IsClient;
use Darkink\AuthorizationServer\Rules\IsUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class EvaluateTestRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'client' => ['required', new IsClient('', true)],
            'user' => ['required', new IsUser()],
            'evaluation_mode' => ['required', new Enum(EvaluatorRequestResponseMode::class)],
        ];
    }

    // public function validatedAsModel()
    // {
    //     $result = $this->validator->validated();
    //     $result['client'] =
    //     return $result;
    // }

}
