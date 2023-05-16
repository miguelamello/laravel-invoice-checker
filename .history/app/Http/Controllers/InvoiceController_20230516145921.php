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

    public function listByStatus($name)
    {
        //Fordib the use of special characters
        $sanitized_name = filter_var($name, FILTER_SANITIZE_STRING);
        $sanitized_name = trim($sanitized_name);

        //Check if the $name has an invalid length
        if (strlen($sanitized_name) === 0) {
            //Return error if the $name is not valid
            return response()->json(['error' => 'Product Name length not valid.'], 404);
        }

        //Return Product(s)
        return response()->json(
            Products::where('name', 'like', "$sanitized_name%")
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
        return response()->json(Invoices::find($id));
        
    }
}
