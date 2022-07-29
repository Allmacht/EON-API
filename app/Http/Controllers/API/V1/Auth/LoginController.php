<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(LoginRequest $request): JsonResponse
    {
        $user = $this->userRepository->getUserByEmail($request->safe()->email);

        if (! $user || ! auth()->attempt($request->safe()->only('email', 'password'))) {
            throw new AuthenticationException();
        }

        $user->tokens()->delete();

        $token = $user->createToken('EON-API-ACCESS-TOKEN')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'expires_in' => 21600,
            'token_type' => 'Bearer',
        ]);
    }
}
