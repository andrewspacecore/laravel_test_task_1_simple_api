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
        try {
            CreateSubmissionJob::dispatch($request->validated());

            return response()->json([
                'status' => Response::HTTP_ACCEPTED,
                'message' => 'Submission is being processed.'
            ], Response::HTTP_ACCEPTED);
        } catch (\Exception $e) {
            return response()->json([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => 'There was an error processing your submission.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
