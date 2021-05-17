<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Customer::where('company_id', $request->company_id)->get());
    }

    public function datatable(Request $request)
    {
        setlocale(LC_ALL, 'tr_TR.UTF-8');
        setlocale(LC_TIME, 'Turkish');

        return Datatables::of(Customer::with([])->where('company_id', $request->company_id))->
        editColumn('id', function ($customer) {
            return '#' . $customer->id;
        })->
        editColumn('company_id', function ($customer) {
            return $customer->company_id ? @$customer->company->name : '';
        })->
        editColumn('class_id', function ($customer) {
            return $customer->class_id ? @$customer->class->name : '';
        })->
        editColumn('type_id', function ($customer) {
            return $customer->type_id ? @$customer->type->name : '';
        })->
        editColumn('reference_id', function ($customer) {
            return $customer->reference_id ? @$customer->reference->name : '';
        })->
        editColumn('country_id', function ($customer) {
            return $customer->country_id ? @$customer->country->name : '';
        })->
        make(true);
    }

    public function show(Request $request)
    {
        return response()->json(Customer::find($request->id), 200);
    }

    public function save(Request $request)
    {
        $customerService = new CustomerService;
        $customerService->setCustomer($request->id ? Customer::find($request->id) : new Customer);
        $customerService->save($request);
    }
}
