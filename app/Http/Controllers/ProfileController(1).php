<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Area;
use App\Models\Caste;
use App\Models\Gotra;
use App\Models\CountryCode;
use App\Models\Education;
use App\Models\Occupation;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Manage Profiles');
    }
    
    // Show all profiles
    public function index(Request $request)
    {
        $query = Profile::query();
    
        if ($request->name) {
            $query->where('name', 'LIKE', "%{$request->name}%");
        }
    
        if ($request->mobile) {
            $query->where('mobile', 'LIKE', "%{$request->mobile}%");
        }
    
        if ($request->gender) {
            $query->where('gender', $request->gender);
        }
    
        if ($request->marital_status) {
            $query->where('marital_status', $request->marital_status);
        }
    
        if ($request->caste) {
            $query->where('caste', 'LIKE', "%{$request->caste}%");
        }
    
        if ($request->place_of_birth) {
            $query->where('place_of_birth', 'LIKE', "%{$request->place_of_birth}%");
        }
    
        // DOB Filter From-To
        if ($request->dob_from) {
            $query->whereDate('date_of_birth', '>=', $request->dob_from);
        }
    
        if ($request->dob_to) {
            $query->whereDate('date_of_birth', '<=', $request->dob_to);
        }
    
        $profiles = $query->latest()->paginate(10)->appends($request->query());
    
        return view('profiles.index', compact('profiles'));
    }


    // Show create form
    public function create()
    {
        $Area           =   Area::get();
        $Caste          =   Caste::get();
        $Gotra          =   Gotra::get();
        $CountryCode    =   CountryCode::get();        
        $Education      =   Education::get();    
        $Occupation     =   Occupation::get();    
        return view('profiles.create', compact('Area', 'Caste', 'Gotra', 'CountryCode', 'Education', 'Occupation'));
    }

    // Store form data
    public function store(Request $request)
    {
        $data = $request->validate([
    
            // ================= BASIC =================
            'title' => 'nullable|string|max:10',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'country_code' => 'nullable|string|max:10',
            'mobile' => 'nullable|string|max:20',
            'gender' => 'nullable|string|max:20',
            'highest_qualification' => 'nullable|string|max:255',
    
            // ================= BIRTH =================
            'dob' => 'nullable|date',
            'tob' => 'nullable',
            'birth_place' => 'nullable|string|max:255',
            'marital_status' => 'nullable|string|max:50',
    
            // ================= PERSONAL =================
            'mangal_dosh' => 'nullable|string|max:20',
            'gotra' => 'nullable|string|max:255',
            'diet' => 'nullable|string|max:50',
    
            // ================= PROFESSIONAL =================
            'occupation' => 'nullable|string|max:255',
            'self_income' => 'nullable|string|max:50',
            'family_income' => 'nullable|string|max:50',
            'budget_demand' => 'nullable|string|max:50',
    
            // ================= RELIGION =================
            'religion' => 'nullable|string|max:50',
            'caste' => 'nullable|string|max:255',
    
            // ================= FAMILY =================
            'father_first' => 'nullable|string|max:255',
            'father_middle' => 'nullable|string|max:255',
            'father_last' => 'nullable|string|max:255',
            'father_occupation' => 'nullable|string|max:255',
    
            'mother_first' => 'nullable|string|max:255',
            'mother_middle' => 'nullable|string|max:255',
            'mother_last' => 'nullable|string|max:255',
            'mother_occupation' => 'nullable|string|max:255',
    
            'brothers' => 'nullable|integer|min:0',
            'sisters' => 'nullable|integer|min:0',
    
            // ================= ADDRESS =================
            'house_no' => 'nullable|string|max:255',
            'colony' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'district' => 'nullable|string|max:100',
    
            // ================= PARTNER =================
            'caste_barrier' => 'nullable|string|max:50',
            'partner_income' => 'nullable|string|max:50',
            'partner_budget_demand' => 'nullable|string|max:50',
            'horoscope' => 'nullable|string|max:10',
    
            // MULTIPLE AREA
            'area_preference' => 'nullable|array',
            'area_preference.*' => 'string|max:100',
    
            // IMAGES
            'self_images' => 'nullable|array',
            'self_images.*' => 'string',
        ]);
    
        // ================= HEIGHT (Feet+Inch → CM) =================
        if ($request->filled('height_feet') || $request->filled('height_inch')) {
            $feet  = (int) $request->height_feet;
            $inch  = (int) $request->height_inch;
            $data['height_cm'] = round((($feet * 12) + $inch) * 2.54);
        }
    
        // ================= JSON FIELDS =================
        $data['area_preference'] = $request->area_preference ?? [];
        $data['self_images'] = $request->self_images ?? [];
    
        Profile::create($data);
    
        return redirect()->back()->with('success', 'Profile created successfully');
    }


    // Show single profile
    public function show(Profile $profile)
    {
        return view('profiles.show', compact('profile'));
    }

    // Show edit form
    public function edit(Profile $profile)
    {
        $Area           =   Area::get();
        $Caste          =   Caste::get();
        $Gotra          =   Gotra::get();
        $CountryCode    =   CountryCode::get();        
        $Education      =   Education::get();    
        $Occupation     =   Occupation::get(); 
        return view('profiles.edit', compact('profile','Area', 'Caste', 'Gotra', 'CountryCode', 'Education', 'Occupation'));
    }

    // Update profile
    public function update(Request $request, Profile $profile)
    {
        $data = $request->validate([
    
            // SAME VALIDATION AS STORE
            'title' => 'nullable|string|max:10',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'country_code' => 'nullable|string|max:10',
            'mobile' => 'nullable|string|max:20',
            'gender' => 'nullable|string|max:20',
            'highest_qualification' => 'nullable|string|max:255',
    
            'dob' => 'nullable|date',
            'tob' => 'nullable',
            'birth_place' => 'nullable|string|max:255',
            'marital_status' => 'nullable|string|max:50',
    
            'mangal_dosh' => 'nullable|string|max:20',
            'gotra' => 'nullable|string|max:255',
            'diet' => 'nullable|string|max:50',
    
            'occupation' => 'nullable|string|max:255',
            'self_income' => 'nullable|string|max:50',
            'family_income' => 'nullable|string|max:50',
            'budget_demand' => 'nullable|string|max:50',
    
            'religion' => 'nullable|string|max:50',
            'caste' => 'nullable|string|max:255',
    
            'father_first' => 'nullable|string|max:255',
            'father_middle' => 'nullable|string|max:255',
            'father_last' => 'nullable|string|max:255',
            'father_occupation' => 'nullable|string|max:255',
    
            'mother_first' => 'nullable|string|max:255',
            'mother_middle' => 'nullable|string|max:255',
            'mother_last' => 'nullable|string|max:255',
            'mother_occupation' => 'nullable|string|max:255',
    
            'brothers' => 'nullable|integer|min:0',
            'sisters' => 'nullable|integer|min:0',
    
            'house_no' => 'nullable|string|max:255',
            'colony' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'district' => 'nullable|string|max:100',
    
            'caste_barrier' => 'nullable|string|max:50',
            'partner_income' => 'nullable|string|max:50',
            'partner_budget_demand' => 'nullable|string|max:50',
            'horoscope' => 'nullable|string|max:10',
    
            'area_preference' => 'nullable|array',
            'area_preference.*' => 'string|max:100',
    
            'self_images' => 'nullable|array',
            'self_images.*' => 'string',
        ]);
    
        // HEIGHT
        if ($request->filled('height_feet') || $request->filled('height_inch')) {
            $feet  = (int) $request->height_feet;
            $inch  = (int) $request->height_inch;
            $data['height_cm'] = round((($feet * 12) + $inch) * 2.54);
        }
    
        // JSON
        $data['area_preference'] = $request->area_preference ?? [];
        $data['self_images'] = $request->self_images ?? $profile->self_images;
    
        $profile->update($data);
    
        return redirect()->back()->with('success', 'Profile updated successfully');
    }


    // Delete profile
    public function destroy(Profile $profile)
    {
        // Delete images
        if ($profile->self_images) {
            foreach ($profile->self_images as $img) {
                Storage::disk('public')->delete($img);
            }
        }

        $profile->delete();

        return redirect()->route('admin.profiles.index')->with('success', 'Profile deleted successfully.');
    }
    
    public function uploadImage(Request $request)
    {
        if (!$request->hasFile('file')) {
            return response()->json(['error' => 'No file uploaded'], 400);
        }
    
        $file = $request->file('file');
    
        // Store image
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('storage/profiles'), $filename);
        
        $path = 'profiles/' . $filename;
    
        return response()->json([
            'success' => true,
            'file' => $path
        ]);
    }

}
