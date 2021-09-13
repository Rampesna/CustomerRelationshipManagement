<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Api\Crm;
use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryErpController extends Controller
{
    public function index(Request $request)
    {
        return (new Crm)->getUlkeListesi()['Response'];
    }
}
