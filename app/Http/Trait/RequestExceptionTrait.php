<?php

namespace App\Http\Trait;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait RequestExceptionTrait
{
    /**
     * @param  Validator  $validator
     * @return JsonResponse
     */
    public function failedValidation(Validator $validator): JsonResponse
    {
        throw new HttpResponseException(
            response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'errors' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }

    /**
     * @return JsonResponse
     */
    protected function failedAuthorization(): JsonResponse
    {
        throw new HttpResponseException(
            response()->json([
                'status' => Response::HTTP_UNAUTHORIZED,
                'message' => "Unauthorized",
            ], Response::HTTP_UNAUTHORIZED)
        );
    }
}
