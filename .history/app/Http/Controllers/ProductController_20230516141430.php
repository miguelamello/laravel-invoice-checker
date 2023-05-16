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

        //Check if the $name has an invalid length
        if (strlen($name) !== 36) {
            //Return error if the $name is not valid
            return response()->json(['error' => 'Product ID length not valid.'], 404);
        }

        //Return the Product
        return response()->json(Products::find($name));
        
    }

    public function getProduct($id)
    {

        //Check if the $id has an invalid UUID length
        if (strlen($id) !== 36) {
            //Return error if the $id is not valid
            return response()->json(['error' => 'Product ID length not valid.'], 404);
        }

        //Return the Product
        return response()->json(Products::find($id));
        
    }
}
