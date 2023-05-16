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

    public function listByStatus($status)
    {
        //Fordib the use of special characters
        $sanitized_status = filter_var($status, FILTER_SANITIZE_STRING);
        $sanitized_status = trim($sanitized_status);

        //Check if $status has an invalid length
        if (strlen($sanitized_status) === 0) {
            //Return error if $status is not valid
            return response()->json(['error' => 'Invoice Status length not valid.'], 404);
        }

        //Return Product(s)
        return response()->json(
            Invoices::where('status', 'like', $sanitized_status)
            
            ->take(100)
            ->get()
        );
        
    }

    public function getInvoice($id)
    {

        //Fordib the use of special characters
        $sanitized_id = filter_var($id, FILTER_SANITIZE_STRING);
        $sanitized_id = trim($sanitized_id);

        //Check if $id has a valid UUID length
        if (strlen($sanitized_id) !== 36) {
            //Return error if $id is not valid
            return response()->json(['error' => 'Invoice Id length not valid.'], 404);            
        }

        //Return Invoice
        $invoices = Invoices::find($id);
        echo $invoices->company
        return response()->json($invoices);
        
    }
}
