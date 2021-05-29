<?php

namespace App\Http\Controllers\Ajax;

use App\Helper\General;
use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Services\CustomerService;
use App\Services\ManagerService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ManagerController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Manager::get());
    }

    public function datatable(Request $request)
    {
        setlocale(LC_ALL, 'tr_TR.UTF-8');
        setlocale(LC_TIME, 'Turkish');

        return Datatables::of(Manager::with([]))->
        editColumn('id', function ($manager) {
            return '#' . $manager->id;
        })->
        editColumn('customer_id', function ($manager) {
            return @$manager->customer ? @$manager->customer->title : '';
        })->
        editColumn('birth_date', function ($manager) {
            return $manager->birth_date ? @date('d.m.Y', strtotime($manager->birth_date)) : '';
        })->
        editColumn('gender', function ($manager) {
            return $manager->gender == 1 ? 'Erkek' : 'Kadın';
        })->
        editColumn('email', function ($manager) {
            return '<a href="mailto:' . $manager->email . '">' . $manager->email . '</a>';
        })->
        editColumn('phone_number', function ($manager) {
            return '<a href="tel:' . '+' . @$manager->customer->country->code . @General::clearPhoneNumber($manager->phone_number) . '">' . '+' . @$manager->customer->country->code . ' ' . @$manager->phone_number . '</a>';
        })->
        editColumn('department_id', function ($manager) {
            return $manager->department_id ? @$manager->department->name : '';
        })->
        editColumn('title_id', function ($manager) {
            return $manager->title_id ? @$manager->title->name : '';
        })->
        rawColumns(['phone_number', 'email'])->
        make(true);
    }

    public function show(Request $request)
    {
        return response()->json(Manager::with([
            'customer'
        ])->find($request->id), 200);
    }

    public function save(Request $request)
    {
        $managerService = new ManagerService;
        $managerService->setManager($request->id ? Manager::find($request->id) : new Manager);
        $managerService->save($request);
    }

    public function drop(Request $request)
    {
        Manager::find($request->id)->delete();
    }
}
