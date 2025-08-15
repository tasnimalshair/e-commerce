<?php

namespace App;

trait ApiResponse
{
    public function successMessage($message = 'Success', $statusCode = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
        ], $statusCode);
    }

    public function success($message = 'Success', $data = [], $statusCode = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    public function error($message = 'Error', $statusCode = 400)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
        ], $statusCode);
    }
}
