<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class ReceiptDetailController extends ApiBaseController {
    public function create(Request $request) {
        try {

        } catch (\Exception $e) {
            return $this->errorApiResponse(500, $e->getMessage());
        }
    }
}