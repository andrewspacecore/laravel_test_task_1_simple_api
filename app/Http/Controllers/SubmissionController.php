<?php

namespace App\Http\Controllers;

use App\Http\Requests\Submission\CreateSubmissionRequest;
use App\Jobs\Submission\CreateSubmissionJob;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SubmissionController
{
    /**
     * @param CreateSubmissionRequest $request
     * @return JsonResponse
     */
    public function submissionSubmitAction(CreateSubmissionRequest $request): JsonResponse
    {
        CreateSubmissionJob::dispatch($request->validated());

        return response()->json([
            'status' => Response::HTTP_ACCEPTED,
            'message' => 'Submission is being processed.'
        ], Response::HTTP_ACCEPTED);
    }
}
