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
        //Return the last 100 invoices ordered by date
        return response()->json(
            Invoices::orderBy('date', 'desc')
            ->take(100)
            ->get()
        );

    }

    public function getInvoice($id)
    {

        //Fordib the use of special characters
        $sanitized_id = filter_var($id, FILTER_SANITIZE_STRING);
        $sanitized_id = trim($sanitized_id);

        //Check if the ID has a valid UUID length
        if (strlen($sanitized_id) !== 36) {
            //Return Invoice
            return response()->json(Invoices::find($id));
            
        }

        //Return error if the ID is not valid
        return response()->json(['error' => 'Invoice ID length not valid.'], 404);
        
    }
}
