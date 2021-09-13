<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function all(Request $request)
    {
        return response()->json(Province::all(), 200);
    }

    public function index(Request $request)
    {
        return response()->json($request->country_id ? Province::where('country_id', $request->country_id)->get() : (
        $request->countries ? Province::whereIn('country_id', $request->countries)->get() : []
        ), 200);
    }

    public function byCountries(Request $request)
    {
        return response()->json(Province::where('country_id', $request->country_id)->get(), 200);
    }
}
