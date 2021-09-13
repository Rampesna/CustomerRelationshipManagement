<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Api\Crm;
use App\Http\Controllers\Controller;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictErpController extends Controller
{
    public function index(Request $request)
    {
        return (new Crm)->getIlceListesi()['Response'];
    }
}
