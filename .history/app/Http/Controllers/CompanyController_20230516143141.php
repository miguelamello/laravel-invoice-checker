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

    public function getCompany($id)
    {

        //Check if the ID has a valid UUID length
        if (strlen(trim($id)) === 36) {
            //Return company
            return response()->json(Companies::find($id));
        }

        //Return error if the ID is not valid
        return response()->json(['error' => 'Company ID length not valid.'], 404);
        
    }
}
