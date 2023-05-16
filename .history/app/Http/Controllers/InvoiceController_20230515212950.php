<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InvoiceController extends Controller
{
    public function lasted()
    {
        return response()->json([1,2,3]);
    }
}
