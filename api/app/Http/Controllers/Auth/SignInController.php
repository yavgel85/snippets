<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SignInController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (!$token = auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'errors' => [
                    'email' => ['Could not sign you in with those details.']
                ],
            ], 422);
        }

        return response()->json([
            'data' => compact('token'),
        ]);
    }
}
