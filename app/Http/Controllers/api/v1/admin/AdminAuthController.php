<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    protected $authService;

    public function __construct()
    {
        $this->authService = new AuthService('admin');
    }

    /**
     * Sign an admin in.
     *
     * @param LoginRequest $request
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(LoginRequest $request) : JsonResponse
    {
        if ($token = $this->authService->login($request->email, $request->password)) {
            $admin = Admin::whereEmail($request->email)->first();

            return successResponse([
                'name'        => $admin->name,
                'email'       => $admin->email,
                'roles'       => $admin->roles->pluck('name')->toArray(),
                'permissions' => $admin->permissions->pluck('name')->toArray(),
                'token'       => $token,
            ]);
        }

        return errorResponse('Invalid credentials', 401);
    }

    /**
     * Sign an admin out.
     *
     * @param LoginRequest $request
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy() : JsonResponse
    {
        if ($this->authService->logout(auth('admin')->user()->email)) {
            return successResponse();
        }

        return errorResponse('Unable to logout! Please try again later');
    }
}
