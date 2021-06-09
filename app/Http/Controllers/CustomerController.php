<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\Crm;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return view('pages.customer.index');
    }

    public function show(Request $request)
    {
        $customer = Customer::find($request->id);
        try {
            return view('pages.customer.show.' . $request->tab . '.index', [
                'customer' => $customer,
                'tab' => $request->tab,
                'balance' => $request->tab == 'index' ? (new Crm)->getMusteriTicariProgramBakiye($customer->code) ?? '--' : '--',
                'finances' => $request->tab == 'finance-activity' ? (new Crm)->getTicariProgramFinansalHareketler($customer->code) ?? [] : [],
                'purchases' => $request->tab == 'purchase' ? (new Crm)->getTicariProgramFaturaHareketler($customer->code)['Response'] ?? [] : [],
                'orders' => $request->tab == 'erp-order' ? (new Crm)->getTicariProgramSiparisHareketler($customer->code) ?? [] : [],
            ]);
        } catch (\Exception $exception) {
            return view('pages.customer.show.' . $request->tab . '.index', [
                'customer' => $customer,
                'tab' => $request->tab,
                'finances' => [],
                'purchases' => [],
                'orders' => [],
            ]);
        }
    }
}
