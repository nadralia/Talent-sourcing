<?php

namespace App\Http\Controllers\api\v1\talent;

use Illuminate\Http\JsonResponse;

class ProfileCompletenessController
{
    /**
     * Return the talent's profile completeness.
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show() : JsonResponse
    {
        return successResponse(auth('talent')->user()->getData('completeness', 'int', 0));
    }
}
