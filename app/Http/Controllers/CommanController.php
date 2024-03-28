<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\City;

class CommanController extends Controller
{

    public function fetchState(Request $request)
    {
        $data['states'] = State::where("country_id", $request->country_id)
                                ->get(["name", "id"]);
  
        return response()->json($data);
    }
 
    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("state_id", $request->state_id)
                                    ->get(["name", "id"]);
                                      
        return response()->json($data);
    }
}
