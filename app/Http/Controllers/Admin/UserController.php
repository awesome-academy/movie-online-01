<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
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
        if ($request->ajax()) {
            $data = User::latest()->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" class="edit btn btn-primary btn-sm editUser">' . __('label.edit') . '</a>';
                        $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" class="btn btn-danger btn-sm deleteUser">' . __('label.delete') . '</a>';
                    
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
                }

           return view('backend.user.index');
    }
}
