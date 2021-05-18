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

    public function activityMeetingReasons(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('definition_id', 6)->get());
    }

    public function activityPriorities(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('definition_id', 7)->get());
    }

    public function customerClasses(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('definition_id', 8)->get());
    }

    public function customerTypes(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('definition_id', 9)->get());
    }

    public function customerReferences(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('definition_id', 10)->get());
    }

    public function managerDepartments(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('definition_id', 11)->get());
    }

    public function managerTitles(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('definition_id', 12)->get());
    }

    public function cargoCompanies(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('definition_id', 13)->get());
    }

    public function sampleStatuses(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('definition_id', 14)->get());
    }

    public function offerPayTypes(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('definition_id', 15)->get());
    }

    public function offerDeliveryTypes(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('definition_id', 16)->get());
    }

    public function offerStatuses(Request $request)
    {
        return response()->json(Definition::where('company_id', $request->company_id)->where('definition_id', 17)->get());
    }
}
