<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Traits\ApiResponser;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Repositories\UserRepositoryInterface;

class AuthController extends Controller
{
    use ApiResponser;
    protected $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user   = $user;
    }

    public function register(RegisterRequest $request)
    {
        $data = [
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password)
        ];
        $user = $this->user->store($data);
        return $this->errorResponse($user,  'User created successfully', 200);
    }

    public function authenticate(AuthRequest $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->errorResponse([], "Login credentials are invalid.", 401);
            }
        } catch (JWTException $e) {
            return $this->errorResponse([], "Could not create token.", 500);
        }
        return $this->successResponse(["user", auth()->user(), "token" => $token], "Logged in successfully", 200);
    }

    public function logout()
    {
        auth()->logout();
        return $this->successResponse([], "You have been successfully logged out!", 200);
    }
}
