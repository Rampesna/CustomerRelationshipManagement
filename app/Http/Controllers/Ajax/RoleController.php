<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Role::all());
    }

    public function datatable(Request $request)
    {
        return Datatables::of(Role::with([])->where('id', '<>', 1))->make(true);
    }

    public function show(Request $request)
    {
        return response()->json(Role::with(['permissions'])->find($request->id), 200);
    }

    public function save(Request $request)
    {
        $roleService = new RoleService;
        $roleService->setRole($request->id ? Role::find($request->id) : new Role);
        $roleService->save($request);
    }

    public function drop(Request $request)
    {
        Role::find($request->id)->delete();
    }
}
