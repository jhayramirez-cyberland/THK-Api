<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use App\Traits\HttpResponse;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    use HttpResponse;

    public function __construct(protected AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        try {
            $result = $this->authService->login($request->all());
            return $this->sendResponse($result, 'Login Successfully!');
        } catch (\Throwable $th) {
            return $this->errorException($th, 'Login Failed');
        }
    }
}
