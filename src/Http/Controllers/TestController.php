<?php

namespace Darkink\AuthorizationServerUI\Http\Controllers;

use Darkink\AuthorizationServer\Helpers\Evaluator\EvaluatorRequest;
use Darkink\AuthorizationServer\Http\Requests\Evaluator\EvaluatorRequestResponseMode;
use Darkink\AuthorizationServer\Repositories\ClientRepository;
use Darkink\AuthorizationServer\Repositories\UserRepository;
use Darkink\AuthorizationServer\Services\IEvaluatorService;
use Darkink\AuthorizationServerUI\Http\Requests\Test\EvaluateTestRequest;

class TestController
{
    protected IEvaluatorService $evaluationService;
    protected ClientRepository $clienRepository;
    protected UserRepository $userRepository;

    public function __construct(
        IEvaluatorService $evaluationService,
        ClientRepository $clienRepository,
        UserRepository $userRepository
    ) {
        $this->evaluationService = $evaluationService;
        $this->clienRepository = $clienRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return view('policy-ui::Test.index', [
            'item' => new EvaluateTestRequest(),
            'result' => null
        ]);
    }

    public function evaluate(EvaluateTestRequest $request)
    {
        $validated = $request->validated();

        $client = $this->clienRepository->find($validated['client']);
        $user = $this->userRepository->find($validated['user']);
        $response_mode = EvaluatorRequestResponseMode::tryFrom($validated['evaluation_mode']);

        $evaluatorRequest = new EvaluatorRequest($client, $user, []);

        $result =  $this->evaluationService->hanlde($evaluatorRequest, $response_mode);
        $resultAsArray = $result->toArray($request);

        $res = $resultAsArray['payload']['permissions'];

        return view('policy-ui::Test.index', [
            'item' => $request,
            'result' => $res
        ]);
    }
}
