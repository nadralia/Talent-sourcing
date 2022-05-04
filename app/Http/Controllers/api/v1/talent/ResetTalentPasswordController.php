<?php

namespace App\Http\Controllers\api\v1\talent;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\ResetPasswordFormRequest;

class ResetTalentPasswordController extends Controller
{
    /**
     * Set the authentication guard to use the talents table
     *
     * @return \Illuminate\Support\Facades\Password
     */
    protected function guard()
    {
        return Auth::guard('talent');
    }

    /**
     * Set the password broker to use the talents table
     *
     * @return \Illuminate\Support\Facades\Password
     */
    protected function broker()
    {
        return Password::broker('talents');
    }

    /**
     * Handle an incoming new password request.
     *
     * @param  \App\Requests\ResetPasswordFormRequest  $request
     * @return \Illuminate\Support\Facades\Password
     */
    public function store(ResetPasswordFormRequest $request)
    {
        $status = Password::reset(
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
