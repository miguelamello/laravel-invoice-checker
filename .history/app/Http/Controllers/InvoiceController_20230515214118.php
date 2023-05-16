<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function listing()
    {
        return response()->json([1,2,3]);
    }
}
