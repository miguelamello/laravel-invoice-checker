<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class ApiException extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            return response()->json(['error' => 'Not found'], 404);
        }
        return parent::render($request, $exception);
    }
}
