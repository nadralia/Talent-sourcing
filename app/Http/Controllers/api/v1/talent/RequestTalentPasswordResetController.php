<?php

namespace App\Http\Controllers\api\v1\talent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class RequestTalentPasswordResetController extends Controller
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
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([ 'email' => [ 'required', 'email' ] ]);

        $status = Password::sendResetLink($request->only('email'));

        return $status == Password::RESET_LINK_SENT
            ? successResponse()
            : errorResponse($status);
    }
}
