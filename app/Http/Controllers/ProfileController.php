<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('profile');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $profile)
    {
        $defaultImg = $profile->avatar == null ? asset(config('setting.client_image.placeholder') . 'placeholder.png') : $profile->avatar;

        return view('client.profile', compact('profile', 'defaultImg'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $profile)
    {
        if ($request->ajax()) {
            if ($request->full_name) {
                $profile->full_name = $request->full_name;
            }

            if ($request->hasFile('select_file')) {
                $fileName = uniqid() . '.' . $request->select_file->extension();
                $path = $request->select_file->storeAs('images/user', $fileName);
                $profile->avatar = $path;
            }
            $profile->save();

            return response()->json([
                'message' => __('Avatar Uploaded Successfully'),
            ]);
        }
    }
}
