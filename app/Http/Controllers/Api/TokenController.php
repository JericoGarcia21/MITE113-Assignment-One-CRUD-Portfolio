<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TokenController extends Controller
{
    /**
     * Issue a bearer token for the given credentials.
     *
     * POST /api/tokens/create
     * Body: { email, password, device_name? }
     *
     * Optionally pass abilities[]=reports:read to scope the token.
     *
     * @throws ValidationException
     */
    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'device_name' => ['sometimes', 'string', 'max:255'],
            'abilities' => ['sometimes', 'array'],
            'abilities.*' => ['string'],
        ]);

        if (! Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        /** @var User $user */
        $user = Auth::user();
        $deviceName = $request->input('device_name', 'api-client');
        $abilities = $request->input('abilities', ['*']);

        $token = $user->createToken($deviceName, $abilities);

        return response()->json([
            'token' => $token->plainTextToken,
        ], 201);
    }

    /**
     * Revoke the token that was used to authenticate this request.
     *
     * POST /api/logout
     */
    public function destroy(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Token revoked.']);
    }
}
