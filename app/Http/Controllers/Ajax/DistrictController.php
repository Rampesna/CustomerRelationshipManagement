<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function all()
    {
        return response()->json(District::all(), 200);
    }

    public function index(Request $request)
    {
        return response()->json(District::where('province_id', $request->province_id)->get(), 200);
    }
}
