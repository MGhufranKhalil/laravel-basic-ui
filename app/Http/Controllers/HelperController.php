<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class HelperController extends Controller
{
    public function getCities($country_id)
    {
        $cities = City::where('country_id', $country_id)->get();
        return response()->json($cities);
    }
}
