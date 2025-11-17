<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\resident;
use Illuminate\Support\Facades\Hash;

class residentController extends Controller
{
    public function insert(Request $request)
    {
        $validated = $request->validate([
      
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'dateOfBirth' => 'required|date',
            'gender' => 'required|string',
            'contactNo' => 'required|string|max:20',
            'middleName' => 'nullable|string|max:255',
            'suffix' => 'nullable|string|max:10',
            'civilStatus' => 'nullable|string',
            'religion' => 'nullable|string',
            'citizenship' => 'nullable|string',
            'voterStatus' => 'nullable|string',
            'precintNo' => 'nullable|string',
            'occupation' => 'nullable|string',
            'employmentStatus' => 'nullable|string',
            'specialGroupStatus' => 'nullable|string',
            'profilePictureData' => 'nullable|string',
            'verificationId' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'houseNumber' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'area' => 'required|string',
            'barangay' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'username' => 'required|string|unique:tbl_residents,username|max:255',
            'password' => 'required|string|min:8',
            
        ]);

        $verificationPath = null;
        if ($request->hasFile('verificationId')) {
            $verificationPath = $request->file('verificationId')->STORE('verification_ids', 'public');
        }

        $resident = resident::create([
            'firstname' => $request->firstName,
            'lastname' => $request->lastName,
            'middlename' => $request->middleName,
            'suffix' => $request->suffix,
            'profile_image' => $request->profilePictureData,
            'house_no' => $request->houseNumber,
            'street' => $request->street,
            'area_no' => $request->area,
            'barangay' => $request->barangay,
            'city' => $request->city,
            'date_of_birth' => $request->dateOfBirth,
            'gender' => $request->gender,
            'civil_no' => $request->civilStatus,
            'contact_no' => $request->contactNo,
            'religion_no' => $request->religion,
            'citizenship' => $request->citizenship,
            'voter_status' => $request->voterStatus,
            'precinct_no' => $request->precintNo,
            'occupation' => $request->occupation,
            'employment_status' => $request->employmentStatus,
            'special_group_no' => $request->specialGroupStatus,
            'verify_image' => $verificationPath,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => "Registration successful!"
        ]);
    }
}
