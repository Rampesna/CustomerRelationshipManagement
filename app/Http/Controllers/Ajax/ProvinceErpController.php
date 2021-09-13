<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Api\Crm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProvinceErpController extends Controller
{
    public function index(Request $request)
    {
        return collect((new Crm)->getSehirListesi()['Response'])->sortByDesc('iller_iladi')->all();
    }
}
