<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Exception;

class Handler extends Exception
{
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            return response()->json(['error' => 'Not found'], 404);
        }
        return parent::render($request, $exception);
    }
}
