<?php

namespace App\Traits;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

trait HttpResponse
{

    public function sendResponse($result, $message, $code = 200)
    {
        $response = [
            'success' => $message,
            'data'    => $result,
        ];
        return response()->json($response, $code);
    }

    public function sendError($error, $errorMessages = [], $code = 400)
    {
        $response = [
            'error' => $error,
        ];
        if (!empty($errorMessages)) {
            $response['message'] = $errorMessages;
        }
        return response()->json($response, $code);
    }

    public function errorException($error, string $errorMessages)
    {
        if ($error instanceof ValidationException) {
            return response()->json([
                "error" => "Validation Error",
                'message' => $error->getMessage(),
            ], $error->status);
        }

        if ($error instanceof QueryException) {
            Log::error($error->getMessage());
            return response()->json([
                "error" => "Database Error",
                'message' => "Database Error",
            ], 500);
        }

        if ($error->getCode() < 300 || $error->getCode() > 500) {
            $statusCode = 500;
        } else {
            $statusCode = $error->getCode();
        }

        return response()->json([
            "error" => $errorMessages,
            'message' => $error->getMessage(),
        ], $statusCode);
    }
}
