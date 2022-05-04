<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\Business;
use App\Models\Talent;

class AuthService
{
    protected $user;
    protected $guard;

    public function __construct(string $user_type = 'talent') {
        $user_types = [
            'admin'    => Admin::class,
            'business' => Business::class,
            'talent'   => Talent::class,
        ];

        $this->user  = $user_types[$user_type];
        $this->guard = $user_type;
    }

    /**
     * Generate access token for a user (admin, business or talent)
     *
     * @param string $email
     * @param string $password
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(string $email, string $password)
    {
        if (! $valid_user = $this->user::whereEmail($email)->selectRaw('id, password')->first()) {
            return false;
        }

        if (! password_verify($password, $valid_user->password)) {
            return false;
        }

        return $valid_user->createToken('BHR', [ $this->guard ])->accessToken;
    }

    /**
     * Revoke access token for a user (admin, business or talent)
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        return auth($this->guard)->user()->token()->revoke();
    }
}
