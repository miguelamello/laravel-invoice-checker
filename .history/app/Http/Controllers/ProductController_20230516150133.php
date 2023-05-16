<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\Products;

class ProductController extends Controller
{
    public function list()
    {
        //Return the last 100 Products ordered by date
        return response()->json(
            Products::orderBy('name', 'desc')
            ->take(100)
            ->get()
        );

    }

    public function listByName($name)
    {
        //Fordib the use of special characters
        $sanitized_name = filter_var($name, FILTER_SANITIZE_STRING);
        $sanitized_name = trim($sanitized_name);

        //Check if $name has an invalid length
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

    public function getProduct($id)
    {

        //Fordib the use of special characters
        $sanitized_id = filter_var($id, FILTER_SANITIZE_STRING);
        $sanitized_id = trim($sanitized_id);

        //Check if the $id has a valid UUID length
        if (strlen($sanitized_id) !== 36) {
            //Return error if the $id is not valid
            return response()->json(['error' => 'Product ID length not valid.'], 404);            
        }

        //Return Product
        return response()->json(Products::find($sanitized_id));
        
    }
}
