<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        return response()->json(Country::all(), 200);
    }

    public function agGrid(Request $request, $fields = [])
    {
        return response()->json(Country::select('name')->get());
    }
}
