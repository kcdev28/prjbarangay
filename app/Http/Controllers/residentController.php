<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\resident;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class residentController extends Controller
{
    /**
     * Display all residents (for admin)
     */
    public function index()
    {
        $residents = resident::with(['civilStatus', 'religion', 'specialGroup', 'area'])
            ->orderBy('residentID', 'asc')
            ->get()
            ->map(function ($resident) {
                // Generate full URLs for images
                $profileImageUrl = $resident->profile_image
                    ? asset('storage/' . $resident->profile_image)
                    : null;

                $verifyImageUrl = $resident->verify_image
                    ? asset('storage/' . $resident->verify_image)
                    : null;

                return [
                    'residentID' => $resident->residentID,
                    'firstname' => $resident->firstname,
                    'middlename' => $resident->middlename,
                    'lastname' => $resident->lastname,
                    'suffix' => $resident->suffix,
                    'profile_image' => $resident->profile_image,
                    'profile_image_url' => $profileImageUrl,
                    'date_of_birth' => $resident->date_of_birth,
                    'gender' => $resident->gender,
                    'civil_no' => $resident->civil_no,
                    'civil_status' => $resident->civilStatus ? $resident->civilStatus->civil_stat : 'N/A',
                    'contact_no' => $resident->contact_no,
                    'religion_no' => $resident->religion_no,
                    'religion' => $resident->religion ? $resident->religion->religion : 'N/A',
                    'citizenship' => $resident->citizenship,
                    'voter_status' => $resident->voter_status,
                    'precinct_no' => $resident->precinct_no,
                    'occupation' => $resident->occupation,
                    'employment_status' => $resident->employment_status,
                    'special_group_no' => $resident->special_group_no,
                    'special_group' => $resident->specialGroup ? $resident->specialGroup->status : 'N/A',
                    'verify_image' => $resident->verify_image,
                    'verify_image_url' => $verifyImageUrl,
                    'house_no' => $resident->house_no,
                    'street' => $resident->street,
                    'area_no' => $resident->area_no,
                    'area' => $resident->area ? $resident->area->area_name : 'N/A',
                    'barangay' => $resident->barangay,
                    'city' => $resident->city,
                    'status' => $resident->status,
                    'username' => $resident->username,
                ];
            });

        return response()->json($residents);
    }

    public function getResidents()
    {
        return $this->index();
    }

    /**
     * Show single resident
     */
    public function show($residentID)
    {
        $resident = resident::with(['civilStatus', 'religion', 'specialGroup', 'area'])
            ->find($residentID);

        if (!$resident) {
            return response()->json([
                'success' => false,
                'message' => 'Resident not found'
            ], 404);
        }

        return response()->json([
            'residentID' => $resident->residentID,
            'firstname' => $resident->firstname,
            'middlename' => $resident->middlename,
            'lastname' => $resident->lastname,
            'suffix' => $resident->suffix,
            'profile_image' => $resident->profile_image,
            'date_of_birth' => $resident->date_of_birth,
            'gender' => $resident->gender,
            'civil_no' => $resident->civil_no,
            'civil_status' => $resident->civilStatus ? $resident->civilStatus->civil_stat : 'N/A',
            'contact_no' => $resident->contact_no,
            'religion_no' => $resident->religion_no,
            'religion' => $resident->religion ? $resident->religion->religion : 'N/A',
            'citizenship' => $resident->citizenship,
            'voter_status' => $resident->voter_status,
            'precinct_no' => $resident->precinct_no,
            'occupation' => $resident->occupation,
            'employment_status' => $resident->employment_status,
            'special_group_no' => $resident->special_group_no,
            'special_group' => $resident->specialGroup ? $resident->specialGroup->status : 'N/A',
            'verify_image' => $resident->verify_image,
            'house_no' => $resident->house_no,
            'street' => $resident->street,
            'area_no' => $resident->area_no,
            'area' => $resident->area ? $resident->area->area_name : 'N/A',
            'barangay' => $resident->barangay,
            'city' => $resident->city,
            'status' => $resident->status,
        ]);
    }

    /**
     * Store new resident (from registration form)
     */
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


            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tbl_residents', 'username'),
                function ($attribute, $value, $fail) {
                    if (DB::table('tbl_users')->where('username', $value)->exists()) {
                        $fail("The username has already been taken.");
                    }
                }
            ],

            'password' => 'required',
        ]);

        $profilePath = null;
        if ($request->profilePictureData) {
            $imageData = $request->profilePictureData;
            $image = str_replace('data:image/png;base64,', '', $imageData);
            $image = str_replace(' ', '+', $image);
            $imageName = 'profile_' . time() . '.png';

            Storage::disk('public')->put('profile_pictures/' . $imageName, base64_decode($image));
            $profilePath = 'profile_pictures/' . $imageName;
        }

        $verificationPath = null;
        if ($request->hasFile('verificationId')) {
            $verificationPath = $request->file('verificationId')->store('verification_ids', 'public');
        }

        $resident = resident::create([
            'firstname' => $request->firstName,
            'lastname' => $request->lastName,
            'middlename' => $request->middleName,
            'suffix' => $request->suffix,
            'profile_image' => $profilePath,
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
            'status' => 'Pending',
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => "Registration successful!"
        ]);
    }

    /**
     * Store new resident (from admin panel)
     */
    public function store(Request $request)
    {
        // Validate required fields
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'civil_status' => 'nullable|string',
            'voter_status' => 'nullable|string',
            'religion' => 'nullable|string',
            'special_group' => 'nullable|string',
            'contact_no' => 'nullable|string|max:20',
            'house_no' => 'nullable|string',
            'street' => 'required|string',
            'area' => 'required|string',
            'barangay' => 'required|string',
            'city' => 'required|string',
            'profile_img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'verify_img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tbl_residents', 'username'),
                function ($attribute, $value, $fail) {
                    if (DB::table('tbl_users')->where('username', $value)->exists()) {
                        $fail("The username has already been taken.");
                    }
                }
            ],

            'password' => 'required',
        ]);

        try {
            $resident = new Resident();

            // Map form data to DB columns
            $resident->firstname = $validated['first_name'];
            $resident->middlename = $request->middle_name ?? null;
            $resident->lastname = $validated['last_name'];
            $resident->suffix = $request->suffix ?? null;
            $resident->date_of_birth = $validated['date_of_birth'];
            $resident->gender = $validated['gender'];
            $resident->civil_no = $request->civil_status ?? null;
            $resident->voter_status = $request->voter_status ?? null;
            $resident->religion_no = $request->religion ?? null;
            $resident->contact_no = $request->contact_no;
            $resident->special_group_no = $request->special_group ?? null;
            $resident->precinct_no = $request->precinct_no ?? null;
            $resident->occupation = $request->occupation ?? null;
            $resident->employment_status = $request->employment_status ?? null;
            $resident->house_no = $request->house_no ?? null;
            $resident->street = $request->street;
            $resident->area_no = $request->area;
            $resident->barangay = $request->barangay;
            $resident->city = $request->city;
            $resident->username = $request->username;
            $resident->password = Hash::make($request->password);

            // Handle profile image
            if ($request->hasFile('profile_img')) {
                $profilePath = $request->file('profile_img')->store('profiles', 'public');
                $resident->profile_image = $profilePath;
            }

            // Handle verification document
            if ($request->hasFile('verify_img')) {
                $verifyPath = $request->file('verify_img')->store('verifications', 'public');
                $resident->verify_image = $verifyPath;
            }

            $resident->status = 'Pending'; // default status

            $resident->save();

            return response()->json([
                'success' => true,
                'resident' => $resident,
                'message' => 'Resident added successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error saving resident: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update resident
     */
    public function update(Request $request, $residentID)
    {
        $resident = resident::find($residentID);

        if (!$resident) {
            return response()->json([
                'success' => false,
                'message' => 'Resident not found'
            ], 404);
        }

        // Validate input
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:10',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'civil_status' => 'nullable|string',
            'religion' => 'nullable|string',
            'voter_status' => 'nullable|string',
            'precinct_no' => 'nullable|string|max:50',
            'contact_no' => 'nullable|string|max:50',
            'occupation' => 'nullable|string|max:255',
            'employment_status' => 'nullable|string|max:50',
            'special_group' => 'nullable|string|max:50',
            'house_no' => 'nullable|string|max:50',
            'street' => 'required|string|max:255',
            'area' => 'nullable|string',
            'barangay' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'profile_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'verify_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tbl_residents', 'username')->ignore($residentID, 'residentID'),
                function ($attribute, $value, $fail) {
                    if (DB::table('tbl_users')->where('username', $value)->exists()) {
                        $fail("The username has already been taken.");
                    }
                }
            ],
            'password' => 'nullable',
        ]);

        // Handle profile image upload
        if ($request->hasFile('profile_img')) {
            if ($resident->profile_image) {
                Storage::disk('public/profile_pictures')->delete($resident->profile_image);
            }
            $resident->profile_image = $request->file('profile_img')->store('profile_pictures', 'public');
        }

        // Handle verification image upload
        if ($request->hasFile('verify_img')) {
            if ($resident->verify_image) {
                Storage::disk('public/verification_ids')->delete($resident->verify_image);
            }
            $resident->verify_image = $request->file('verify_img')->store('verification_ids', 'public');
        }

        // Update other fields
        $resident->firstname = $request->first_name;
        $resident->middlename = $request->middle_name ?? null;
        $resident->lastname = $request->last_name;
        $resident->suffix = $request->suffix ?? null;
        $resident->date_of_birth = $request->date_of_birth;
        $resident->gender = $request->gender;
        $resident->civil_no = $request->civil_status ?? null;
        $resident->religion_no = $request->religion ?? null;
        $resident->voter_status = $request->voter_status ?? null;
        $resident->precinct_no = $request->precinct_no ?? null;
        $resident->contact_no = $request->contact_no ?? null;
        $resident->occupation = $request->occupation ?? null;
        $resident->employment_status = $request->employment_status ?? null;
        $resident->special_group_no = $request->special_group ?? null;
        $resident->house_no = $request->house_no ?? null;
        $resident->street = $request->street;
        $resident->area_no = $request->area ?? null;
        $resident->barangay = $request->barangay;
        $resident->city = $request->city;
        $resident->username = $request->username;

        // Update password only if provided
        if ($request->filled('password')) {
            $resident->password = Hash::make($request->password);
        }

        $resident->save();

        return response()->json([
            'success' => true,
            'message' => 'Resident updated successfully',
            'resident' => $resident
        ]);
    }


    /**
     * Delete resident
     */
    public function destroy($residentID)
    {
        $resident = resident::find($residentID);

        if (!$resident) {
            return response()->json([
                'success' => false,
                'message' => 'Resident not found'
            ], 404);
        }

        // Delete associated files
        if ($resident->profile_image) {
            Storage::disk('public')->delete($resident->profile_image);
        }
        if ($resident->verify_image) {
            Storage::disk('public')->delete($resident->verify_image);
        }

        $resident->delete();

        return response()->json([
            'success' => true,
            'message' => 'Resident deleted successfully'
        ]);
    }
}
