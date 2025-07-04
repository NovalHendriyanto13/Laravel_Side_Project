<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class BaseController extends Controller {

    public function successApiResponse ($data = null, $message = null) {
        if (empty($message)) 
            $message = 'Process Api is success';

        return response()->json([
            'successCode' => 200,
            'success' => true,
            'data' => $data,
            'message' => $message,
        ]);
    }

    public function errorApiResponse ($errorCode = 500, $message = null) {
        if (empty($message)) 
            $message = 'Process Api is failed';

        return response()->json([
            'successCode' => $errorCode,
            'success' => false,
            'data' => null,
            'message' => $message,
        ]);
    }

    public function redirectBack(array $param = []) {
        $defaults = [
            'is_error'   => false,
            'is_input'   => false,
            'is_success' => false,
            'data'       => null,
        ];

        $param = array_merge($defaults, $param);

        $redirect = redirect()->back(); 
        if ($param['is_error']) {
            $redirect = $redirect->withErrors($param['data']);
        }

        if ($param['is_success']) {
            $redirect = $redirect->with($param['data']);
        }

        if ($param['is_input']) {
            $redirect = $redirect->withInput();
        } 

        return $redirect;
    }

    public function redirectRoute($route, $data = null) {
        return redirect()->route($route, $data);
    }
}