<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\resident;

class residentController extends Controller
{
    public function insert(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'house_no' => 'required',
            'street' => 'required',
            'area_no' => 'required',
            'barangay' => 'required',
            'city' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'civil_no' => 'required',
            'contact_no' => 'required',
            'religion_no' => 'required',
            'username' => 'required',
            'password' => 'required',

        ]);

        $idPath = $request->file('verificationId')->store('verification_ids', 'public');

        resident::create([
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

            'verify_image' => $idPath,
            'username' => $request->username,
            'password' =>  $request->password,
        ]);

        return response()->json([
            "message" => "Registration successful!"
        ]);
    }
}
