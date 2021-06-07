<?php

namespace App\Http\Controllers\Ajax;

use App\Helper\General;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Definition;
use App\Models\Manager;
use App\Models\User;
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
        filterColumn('customer_id', function ($managers, $keyword) {
            return $managers->whereIn('customer_id', Customer::where('title', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        filterColumn('gender', function ($managers, $gender) {
            return $gender == 2 ? $managers : $managers->where('gender', $gender);
        })->
        filterColumn('department_id', function ($managers, $keyword) use ($request) {
            return $managers->whereIn('department_id', Definition::where('company_id', $request->company_id)->where('name', 'Yetkili Departmanları')->first()->definitions()->where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
        filterColumn('title_id', function ($managers, $keyword) use ($request) {
            return $managers->whereIn('title_id', Definition::where('company_id', $request->company_id)->where('name', 'Yetkili Ünvanları')->first()->definitions()->where('name', 'like', '%' . $keyword . '%')->pluck('id'));
        })->
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
        $manager = Manager::find($request->id);
        if ($manager->created_by == $request->auth_user_id) {
            $manager->delete();
            return response()->json([
                'type' => 'success',
                'message' => 'Yetkili Başarıyla Silindi'
            ], 200);
        } else {
            if (User::find($request->auth_user_id)->authority(64)) {
                $manager->delete();
                return response()->json([
                    'type' => 'success',
                    'message' => 'Yetkili Başarıyla Silindi'
                ], 200);
            } else {
                return response()->json([
                    'type' => 'warning',
                    'message' => 'Başka Kullanıcıya Ait Verileri Silme Yetkiniz Bulunmuyor!'
                ], 200);
            }
        }
    }
}
