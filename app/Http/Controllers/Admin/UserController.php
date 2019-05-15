<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::latest()->get();
        if ($request->ajax()) {
            $data = User::with('role')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" class="edit btn btn-primary btn-sm editUser">' . __('label.edit') . '</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.user.index', compact('roles'));
    }

    public function store(Request $request)
    {
        User::updateOrCreate(
            [
                'id' => $request->user_id
            ],
            [
                'username' => $request->username,
                'role_id' => $request->role_id,
                'banned' => $request->banned
            ]
        );

        return response()->json(['success' => "{{ trans('message.success') }}"]);
    }

    public function edit($id)
    {
        $user = User::find($id);

        return response()->json($user);
    }
}
