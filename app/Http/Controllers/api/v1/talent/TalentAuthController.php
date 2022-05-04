<?php

namespace App\Http\Controllers\api\v1\talent;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\LogoutRequest;
use App\Models\Talent;
use Illuminate\Http\JsonResponse;

class TalentAuthController extends Controller
{
    protected $authService;

    public function __construct()
    {
        $this->authService = new AuthService('talent');
    }

    /**
     * Sign a talent in.
     *
     * @param LoginRequest $request
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(LoginRequest $request) : JsonResponse
    {
        if ($token = $this->authService->login($request->email, $request->password)) {
            $talent = Talent::whereEmail($request->email)->first();

            return successResponse([
                'id'           => $talent->id,
                'name'         => $talent->full_name,
                'avatar'       => $talent->avatar,
                'email'        => $talent->email,
                'initials'     => $talent->initials,
                'completeness' => $talent->getData('completeness', 'int', 0),
                'roles'        => $talent->roles->pluck('name')->toArray(),
                'permissions'  => $talent->permissions->pluck('name')->toArray(),
                'token'        => $token,
            ]);
        }

        return errorResponse('Invalid credentials', 401);
    }

    /**
     * Sign a talent out.
     *
     * @param LogoutRequest $request
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy() : JsonResponse
    {
        if ($this->authService->logout(auth('talent')->user()->email)) {
            return successResponse();
        }

        return errorResponse('Unable to logout! Please try again later');
    }
}
