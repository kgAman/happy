<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * Show the search page.
     */
    public function index(Request $request)
    {
        // Get initial profiles for demo
        $profiles = Profile::active()->paginate(24);
        
        return view('pages.search.index', compact('profiles'));
    }

    /**
     * Handle search form submission.
     */
    public function search(Request $request)
    {
        $validated = $request->validate([
            'gender' => 'required|in:male,female',
            'religion' => 'nullable|string',
            'age' => 'nullable|string',
            'location' => 'nullable|string',
            'education' => 'nullable|string',
            'profession' => 'nullable|string',
            'min_age' => 'nullable|integer|min:18|max:60',
            'max_age' => 'nullable|integer|min:18|max:60',
            'min_height' => 'nullable|string',
            'max_height' => 'nullable|string',
            'caste' => 'nullable|string',
            'verified' => 'nullable|boolean',
            'premium' => 'nullable|boolean',
            'online' => 'nullable|boolean',
            'photos' => 'nullable|boolean',
        ]);

        // In real application, you would query the database
        $profiles = Profile::active()
            ->verified()
            ->when($request->gender, fn($q) => $q->byGender($request->gender))
            ->when($request->religion, fn($q) => $q->byReligion($request->religion))
            ->when($request->age, function($q) use ($request) {
                [$min, $max] = explode('-', $request->age);
                $q->byAgeRange($min, $max);
            })
            ->when($request->location, fn($q) => $q->byLocation($request->location))
            ->when($request->education, fn($q) => $q->where('education', 'like', "%{$request->education}%"))
            ->when($request->profession, fn($q) => $q->where('profession', 'like', "%{$request->profession}%"))
            ->paginate(24);

        // For demo, return sample profiles
        // $profiles = $this->getDemoProfiles();
        
        return view('pages.search.index', compact('profiles', 'validated'));
    }

    /**
     * Get demo profiles for testing.
     */
    private function getDemoProfiles()
    {
        return [
            [
                'id' => 1,
                'name' => 'Priya Sharma',
                'age' => 28,
                'height' => "5'4\"",
                'image' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'profession' => 'Software Engineer',
                'education' => 'MCA',
                'location' => 'Bangalore',
                'income' => '₹ 15-20 LPA',
                'religion' => 'Hindu',
                'about' => 'Software professional with a passion for technology. Looking for a partner who shares similar values and life goals.',
                'verified' => true,
                'premium' => true,
                'online' => true
            ],
            [
                'id' => 2,
                'name' => 'Raj Patel',
                'age' => 32,
                'height' => "5'11\"",
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'profession' => 'Business Consultant',
                'education' => 'MBA',
                'location' => 'Mumbai',
                'income' => '₹ 25-30 LPA',
                'religion' => 'Hindu',
                'about' => 'Entrepreneurial spirit with successful business ventures. Values family and looking for a life partner.',
                'verified' => true,
                'premium' => true,
                'online' => false
            ],
            [
                'id' => 3,
                'name' => 'Anjali Reddy',
                'age' => 26,
                'height' => "5'3\"",
                'image' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'profession' => 'Doctor',
                'education' => 'MBBS',
                'location' => 'Hyderabad',
                'income' => '₹ 12-18 LPA',
                'religion' => 'Hindu',
                'about' => 'Medical professional dedicated to helping others. Enjoys traveling, reading, and spending time with family.',
                'verified' => true,
                'premium' => false,
                'online' => true
            ],
            [
                'id' => 4,
                'name' => 'Amit Kumar',
                'age' => 30,
                'height' => "5'10\"",
                'image' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'profession' => 'Civil Engineer',
                'education' => 'B.Tech',
                'location' => 'Delhi',
                'income' => '₹ 10-15 LPA',
                'religion' => 'Hindu',
                'about' => 'Professional engineer with passion for architecture. Values honesty and commitment in relationships.',
                'verified' => true,
                'premium' => true,
                'online' => false
            ],
            [
                'id' => 5,
                'name' => 'Sneha Singh',
                'age' => 27,
                'height' => "5'5\"",
                'image' => 'https://images.unsplash.com/photo-1534751516642-a1af1ef26a56?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'profession' => 'Fashion Designer',
                'education' => 'B.Des',
                'location' => 'Mumbai',
                'income' => '₹ 8-12 LPA',
                'religion' => 'Hindu',
                'about' => 'Creative professional with successful fashion brand. Looking for a partner who appreciates art and culture.',
                'verified' => true,
                'premium' => false,
                'online' => true
            ],
            [
                'id' => 6,
                'name' => 'Vikram Malhotra',
                'age' => 35,
                'height' => "6'0\"",
                'image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'profession' => 'Bank Manager',
                'education' => 'MBA Finance',
                'location' => 'Chennai',
                'income' => '₹ 20-25 LPA',
                'religion' => 'Hindu',
                'about' => 'Finance professional with stable career. Enjoys cricket, reading, and family gatherings.',
                'verified' => true,
                'premium' => true,
                'online' => false
            ],
            [
                'id' => 7,
                'name' => 'Neha Gupta',
                'age' => 29,
                'height' => "5'4\"",
                'image' => 'https://images.unsplash.com/photo-1488426862026-3ee34a7d66df?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'profession' => 'Marketing Manager',
                'education' => 'MBA Marketing',
                'location' => 'Delhi',
                'income' => '₹ 18-22 LPA',
                'religion' => 'Hindu',
                'about' => 'Dynamic marketing professional with global experience. Values communication and shared interests.',
                'verified' => true,
                'premium' => true,
                'online' => true
            ],
            [
                'id' => 8,
                'name' => 'Rahul Mehta',
                'age' => 31,
                'height' => "5'9\"",
                'image' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'profession' => 'Lawyer',
                'education' => 'LLB',
                'location' => 'Bangalore',
                'income' => '₹ 22-28 LPA',
                'religion' => 'Hindu',
                'about' => 'Legal professional with successful practice. Looking for a partner with strong family values.',
                'verified' => true,
                'premium' => false,
                'online' => false
            ]
        ];
    }

    /**
     * Get filter counts for sidebar.
     */
    public function getFilterCounts(Request $request)
    {
        $counts = [
            'verified' => Profile::where('verified', true)->count(),
            'premium' => Profile::where('premium', true)->count(),
            'online' => 42, // This would be dynamic in real app
            'education' => [
                'B.Tech/B.E.' => Profile::where('education', 'like', '%B.Tech%')->orWhere('education', 'like', '%B.E.%')->count(),
                'MBA/PGDM' => Profile::where('education', 'like', '%MBA%')->orWhere('education', 'like', '%PGDM%')->count(),
                'MBBS' => Profile::where('education', 'like', '%MBBS%')->count(),
                // Add more as needed
            ],
            'profession' => [
                'Software Engineer' => Profile::where('profession', 'like', '%Software%')->count(),
                'Doctor' => Profile::where('profession', 'like', '%Doctor%')->count(),
                // Add more as needed
            ],
            'location' => [
                'delhi' => Profile::where('city', 'like', '%Delhi%')->count(),
                'mumbai' => Profile::where('city', 'like', '%Mumbai%')->count(),
                // Add more as needed
            ]
        ];

        return response()->json($counts);
    }

    /**
     * Get caste options for a religion.
     */
    public function getCasteOptions($religion)
    {
        $castes = match($religion) {
            'hindu' => ['Brahmin', 'Kshatriya', 'Vaishya', 'Shudra', 'Other'],
            'muslim' => ['Sunni', 'Shia', 'Other'],
            'christian' => ['Catholic', 'Protestant', 'Orthodox', 'Other'],
            'sikh' => ['Jat', 'Khatri', 'Arora', 'Other'],
            'jain' => ['Digambar', 'Shwetambar', 'Other'],
            'buddhist' => ['Theravada', 'Mahayana', 'Vajrayana', 'Other'],
            default => [],
        };

        return response()->json($castes);
    }
}