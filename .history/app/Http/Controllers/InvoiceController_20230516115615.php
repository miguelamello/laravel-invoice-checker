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
        /*
            Return the last 100 invoices ordered by date
        */
        return response()->json(
            Invoices::orderBy('date', 'desc')
            ->take(100)
            ->get()
        );

    }

    public function getInvoice($id)
    {

        if (strlen($id) === 36) {
            return response()->json(Invoices::find($id));
        }

        return response()->json(['error' => 'Invoice ID length not valid.'], 404);
        
    }
}
