<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use App\Models\User;
use Illuminate\Http\Request;

class OpportunityController extends Controller
{
    public function index()
    {
        return view('pages.opportunity.index');
    }

    public function show(Request $request)
    {
        try {
            return view('pages.opportunity.show.' . $request->tab . '.index', [
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
