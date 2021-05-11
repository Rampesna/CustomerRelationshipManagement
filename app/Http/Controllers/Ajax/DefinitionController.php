<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Definition;
use Illuminate\Http\Request;

class DefinitionController extends Controller
{
    public function opportunityPriorities(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('definition_id', 1)->get());
    }

    public function opportunityAccessTypes(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('definition_id', 2)->get());
    }

    public function opportunityEstimatedResultTypes(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('definition_id', 3)->get());
    }

    public function opportunityCapacityTypes(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('definition_id', 4)->get());
    }

    public function opportunityStatuses(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('definition_id', 5)->get());
    }
}
