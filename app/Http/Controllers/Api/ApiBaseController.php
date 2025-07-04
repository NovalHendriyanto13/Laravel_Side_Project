<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ApiBaseController extends Controller {

    public function successApiResponse ($data = null, $message = null) {
        if (empty($message)) 
            $message = 'Process Api is success';

        return response()->json([
            'successCode' => 200,
            'error' => false,
            'data' => $data,
            'message' => $message,
        ]);
    }

    public function errorApiResponse ($errorCode = 500, $message = null) {
        if (empty($message)) 
            $message = 'Process Api is failed';

        return response()->json([
            'successCode' => $errorCode,
            'error' => true,
            'data' => null,
            'message' => $message,
        ], $errorCode);
    }
}