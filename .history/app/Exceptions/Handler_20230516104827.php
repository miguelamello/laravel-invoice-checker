<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;

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
