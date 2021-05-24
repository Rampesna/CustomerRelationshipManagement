<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DefinitionController extends Controller
{
    public function index()
    {
        return view('pages.definition.index');
    }
}
