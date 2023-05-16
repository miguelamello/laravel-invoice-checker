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

        //Check if the ID has a valid UUID length
        if (strlen($name) > 0) {
            return response()->json(Products::find($id));
        }

        //Return error if the ID is not valid
        return response()->json(['error' => 'Product ID length not valid.'], 404);
        
    }

    public function getProduct($id)
    {

        //Check if the ID has a valid UUID length
        if (strlen($id) === 36) {
            return response()->json(Products::find($id));
        }

        //Return error if the ID is not valid
        return response()->json(['error' => 'Product ID length not valid.'], 404);
        
    }
}
