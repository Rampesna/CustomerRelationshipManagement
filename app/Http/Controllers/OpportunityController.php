<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class OpportunityController extends Controller
{
    public function index()
    {
        return view('pages.opportunity.index');
    }
}
