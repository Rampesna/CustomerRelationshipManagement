<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Opportunity;
use Illuminate\Http\Request;

class OpportunityController extends Controller
{
    public function index()
    {
        return view('mobile.opportunity.index');
    }

    public function show(Request $request)
    {
        try {
            return view('mobile.opportunity.show.' . $request->tab . '.index', [
                'opportunity' => Opportunity::with([
                    'customer'
                ])->find($request->id),
                'tab' => $request->tab
            ]);
        } catch (\Exception $exception) {
            return abort(404);
        }
    }
}
