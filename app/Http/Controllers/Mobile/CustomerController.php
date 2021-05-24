<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return view('mobile.customer.index');
    }

    public function show(Request $request)
    {
        try {
            return view('mobile.customer.show.' . $request->tab . '.index', [
                'customer' => Customer::find($request->id),
                'tab' => $request->tab
            ]);
        } catch (\Exception $exception) {
            return abort(404);
        }
    }
}
