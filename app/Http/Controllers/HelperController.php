<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\State;
use App\Models\Employee;

class HelperController extends Controller
{
    public function getStates($country_id) {
        $states = State::where('country_id', $country_id)->get();
        return response()->json($states);
    }
    
    public function getCities($state_id) {
        $cities = City::where('state_id', $state_id)->get();
        return response()->json($cities);
    }

    public function getCompanyEmployees($company_id) {
        $company = Employee::where('company_id', $company_id)->get();
        return response()->json($company);
    }
}
