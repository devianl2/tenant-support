<?php
namespace Tenant\Support\Traits;

use Illuminate\Http\Response;

// Use in Controller.php
trait ApiResponse
{
    public function successResponse($data, $statusCode = Response::HTTP_OK)
    {
        return response($data, $statusCode)->header('Content-Type', 'application/json');
    }
    public function errorResponse($errorMessage, $statusCode)
    {
        return response()->json(['error' => $errorMessage, 'error_code' => $statusCode], $statusCode);
    }
    public function errorMessage($errorMessage, $statusCode)
    {
        return response($errorMessage, $statusCode)->header('Content-Type', 'application/json');
    }
}
