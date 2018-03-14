<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update()
    {
        request()->user()->update(request()->only('name', 'email'));
        return response()->json(['status' => true]);
    }

    public function password()
    {
        if (request('password')!=request('sure_password')) {
            return response()->json(['status' => false]);
        }
        \request()->user()->update(['password' => bcrypt(request('password'))]);
        return response()->json(['status' => true]);
    }
}
