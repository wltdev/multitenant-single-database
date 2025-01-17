<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Client\Request;
use Illuminate\Http\JsonResponse;

class AuthException extends Exception
{
    public function render(Request $request): JsonResponse
    {
        $status = 401;
        $errorMessage = "Invalid user credentials";

        return response()->json([
            'error' => $errorMessage
        ], $status);
    }
}
