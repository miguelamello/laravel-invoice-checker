<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\Companies;

class CompanyController extends Controller
{
    public function list()
    {
        //Return the last 100 companies ordered by created_at
        return response()->json(
            Companies::orderBy('created_at', 'desc')
            ->take(100)
            ->get()
        );

    }

    public function listByName($name)
    {

        //Check if $name has an invalid length
        if (strlen(trim($name)) === 0) {
            //Return error if $name is not valid
            return response()->json(['error' => 'Company Name length not valid.'], 404);
        }

        //Return Product(s)
        return response()->json(
            Companies::where('name', 'like', "$name%")
            ->take(100)
            ->get()
        );
        
    }

    public function getCompany($id)
    {

        //Fordib the use of special characters
        $sanitized_id = filter_var($id, FILTER_SANITIZE_STRING);
        $sanitized_id = trim($sanitized_id);

        //Check if $id has an invalid UUID length
        if (strlen($sanitized_id) !== 36) {
            //Return error if $id is not valid
            return response()->json(['error' => 'Company Id length not valid.'], 404);            
        }

        //Return company
        return response()->json(Companies::find($id));
        
    }
}
