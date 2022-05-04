<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LogoutRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Password;

class RequestPasswordResetController extends Controller
{
    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param string                    $broker The broker to use must be a valid provider in config/auth.php
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(LogoutRequest $request, string $broker) : JsonResponse
    {
        $status = Password::broker($broker)->sendResetLink($request->only('email'));

        if ($status == Password::INVALID_USER) {
            $response = errorResponse('Invalid user', 404);
        } elseif ($status == Password::RESET_THROTTLED) {
            $response = errorResponse('Too many requests!', 429);
        } elseif ($status == Password::RESET_LINK_SENT) {
            $response = successResponse();
        } else {
            $response = errorResponse('Error resetting password... please check your request');
        }

        return $response;
    }
}
