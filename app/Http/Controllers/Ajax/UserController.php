<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Company::find($request->company_id)->users);
    }

    public function datatable(Request $request)
    {
        return Datatables::of(User::with([]))->
        editColumn('id', function ($user) {
            return '#' . $user->id;
        })->
        editColumn('role_id', function ($user) {
            return $user->role_id ? $user->role->name : '';
        })->
        make(true);
    }

    public function show(Request $request)
    {
        return response()->json(User::with(['companies'])->find($request->id));
    }

    public function save(Request $request)
    {
        $userService = new UserService;
        $userService->setUser($request->id ? User::find($request->id) : new User);
        $userService->save($request);
    }

    public function emailControl(Request $request)
    {
        return response()->json(is_null($request->except_id ? User::where('email', $request->email)->where('id', '<>', $request->except_id)->first() : User::where('email', $request->email)->first()) ? false : true);
    }
}
