<?php

// app/Exceptions/Handler.php

use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;

public function register()
{
    App::error(function(Exception $exception) {
        if (Request::is('api/*')) {
            $message = get_class($exception) . ":: message: " . $exception->getMessage();
            return Response::json(["success" => false, "message" => $message]);
        }
    });
}

