<?php

namespace App\Traits;

trait ApiResponses{
    
    protected function ok($message, $data = []){
        return $this->success($message, $data, 200);
    }

    protected function success($message, $data = [], $statusCode = 200){
        return response()->json([
            'data' => $data,
            'message' => $message,
            'status' => $statusCode,
        ], $statusCode);
    }


    protected function error($message = 'Error', $statusCode = 500)
    {
        return response()->json([
            'message' => $message,
            ], $statusCode);
        }
}