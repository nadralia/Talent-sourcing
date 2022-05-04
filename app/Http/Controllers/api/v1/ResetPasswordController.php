<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\ResetPasswordFormRequest;
use Illuminate\Http\JsonResponse;

class ResetPasswordController extends Controller
{
    /**
     * Handle an incoming new password request.
     *
     * @param  \App\Requests\ResetTalentPasswordRequest $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ResetPasswordFormRequest $request) : JsonResponse
    {
        $status = Password::broker($request->broker)->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->update([
                    'password'       => $request->password,
                    'remember_token' => Str::random(60),
                ]);
    
                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET
            ? successResponse()
            : errorResponse('Error resetting password. Check to make sure token is not expired');
    }
}
