<?php

namespace App\Traits;

trait ApiResponseTrait
{
    protected function apiSuccess($data= null,$message = null,$status = null){
        return response([
            'data' => $data,
            'success' => true,
            'message' => $message,
        ], $status);
    }
    protected function apiFailure($data,$message, $status = 422)
    {
        return response([
            'data' => $data,
            'success' => false,
            'message' => $message,
        ], $status);
    }
}
