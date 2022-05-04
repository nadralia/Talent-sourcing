<?php

namespace App\Http\Controllers\api\v1\business;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use App\Http\Requests\LoginRequest;
use App\Models\Business;
use Illuminate\Http\JsonResponse;

class BusinessAuthController extends Controller
{
    protected $authService;

    public function __construct()
    {
        $this->authService = new AuthService('business');
    }

    /**
     * Sign in as a business.
     *
     * @param LoginRequest $request
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(LoginRequest $request) : JsonResponse
    {
        if ($token = $this->authService->login($request->email, $request->password)) {
            $business = Business::whereEmail($request->email)->first();

            return successResponse([
                'name'        => $business->name,
                'email'       => $business->email,
                'roles'       => $business->roles->pluck('name')->toArray(),
                'permissions' => $business->permissions->pluck('name')->toArray(),
                'token'       => $token,
            ]);
        }

        return errorResponse('Invalid credentials', 401);
    }

    /**
     * Sign out as a business
     *
     * @param LoginRequest $request
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy() : JsonResponse
    {
        if ($this->authService->logout(auth('business')->user()->email)) {
            return successResponse();
        }

        return errorResponse('Unable to logout! Please try again later');
    }
}
