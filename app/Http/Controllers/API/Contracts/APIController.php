<?php

namespace App\Http\Controllers\API\Contracts;

use App\Http\Controllers\Controller;

class APIController extends Controller
{
    protected $statusCode;
    public function responseSuccess(string $message ,array $data)
    {
        return $this->setStatusCode(200)->respond($message,true,$data);
    }

    public function responseCreated(string $message ,array $data)
    {
        return $this->setStatusCode(201)->respond($message,true,$data);
    }

    public function responseNotFound(string $message)
    {
        return $this->setStatusCode(404)->respond($message);
    }

    public function responseInternalError(string $message)
    {
        return $this->setStatusCode(500)->respond($message,true);
    }


    private function respond(string $message = '' ,bool $isSuccess = false , array $data = null)
    {
        $responseData = [
            'success' => $isSuccess,
            'message' => $message,
            'data' => $data,
        ];
        return response()->json($responseData)->setStatusCode($this->getStatusCode());
    }

    private function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    private function getStatusCode()
    {
        return $this->statusCode;
    }
}
