<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\Invoices;

class InvoiceController extends Controller
{
    public function list()
    {
        return response()->json(Invoices::all());
    }

    public function getInvoice($id)
    {
        if (strlen($id) === 36) {
            return response()->json(Invoices::find($id));
        }
        return response()->json(strlen($id));
        
    }
}
