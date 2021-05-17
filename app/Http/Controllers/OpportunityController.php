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
        if ($request->tab == 'index') {
            return view('pages.opportunity.show.index.index', [
                'opportunity' => Opportunity::with([
                    'customer'
                ])->find($request->id),
                'tab' => $request->tab
            ]);
        } else if ($request->tab == 'offer') {
            return view('pages.opportunity.show.offer.index', [
                'opportunity' => Opportunity::find($request->id),
                'tab' => $request->tab
            ]);
        } else if ($request->tab == 'activity') {
            return view('pages.opportunity.show.activity.index', [
                'opportunity' => Opportunity::find($request->id),
                'tab' => $request->tab
            ]);
        } else if ($request->tab == 'sample') {
            return view('pages.opportunity.show.sample.index', [
                'opportunity' => Opportunity::find($request->id),
                'tab' => $request->tab
            ]);
        } else if ($request->tab == 'comment') {
            return view('pages.opportunity.show.comment.index', [
                'opportunity' => Opportunity::find($request->id),
                'tab' => $request->tab
            ]);
        } else {
            return abort(404);
        }
    }
}
