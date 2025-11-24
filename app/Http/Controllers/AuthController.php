<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\admin;     // vw_admins
use App\Models\resident;  // tbl_residents

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $request->validate([
            'username' => 'required|string',
            'password' => 'required'
        ]);



        $admin = admin::where('username', $request->username)->first();


        if ($admin && $request->password === $admin->password) {

            session([
                'user_type' => 'admin',
                'user_id'   => $admin->userID,
                'user_name' => $admin->full_name
                 
            ]);

            return redirect()->route('admin.dashboard');
        }



        $resident = resident::where('username', $request->username)->first();

        if ($resident && Hash::check($request->password, $resident->password)) {

            session([
                'user_type' => 'resident',
                'user_id'   => $resident->residentID,
                'user_name' => $resident->firstname . ' ' . $resident->lastname
            ]);

            return redirect()->route('resident.landing');
        }



        return back()->withErrors([
            'username' => 'Invalid username or password'
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }
}
