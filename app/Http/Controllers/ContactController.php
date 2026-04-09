<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display the contact page.
     */
    public function index()
    {
        // Sample data - In real application, this would come from a controller
        $data = [
            'faqs' => [
                [
                    'question' => 'How do I verify my profile?',
                    'answer' => 'Profile verification can be done by uploading government ID proof and a recent photograph. Our team manually verifies all documents within 24-48 hours.'
                ],
                [
                    'question' => 'Can I hide my profile from certain users?',
                    'answer' => 'Yes, we offer privacy settings that allow you to hide your profile from specific users or groups while remaining visible to others.'
                ],
                [
                    'question' => 'How does the matching algorithm work?',
                    'answer' => 'Our AI-powered algorithm analyzes compatibility based on interests, preferences, values, and lifestyle choices to suggest the most suitable matches.'
                ],
                [
                    'question' => 'Is my personal information safe?',
                    'answer' => 'Absolutely. We use bank-level encryption and never share your personal information with third parties without your explicit consent.'
                ],
                [
                    'question' => 'What if I find inappropriate behavior?',
                    'answer' => 'You can report any user directly from their profile. Our moderation team reviews all reports within 6 hours and takes appropriate action.'
                ]
            ],
            
            'teamMembers' => [
                [
                    'name' => 'Priya Sharma',
                    'role' => 'Customer Support Head',
                    'description' => 'With 8+ years in customer service, Priya ensures you get the best support experience.',
                    'email' => 'priya@happilyweds.com',
                    'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
                ],
                [
                    'name' => 'Rajesh Kumar',
                    'role' => 'Technical Support',
                    'description' => 'Expert in resolving technical issues related to profiles, payments, and app functionality.',
                    'email' => 'rajesh@happilyweds.com',
                    'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
                ],
                [
                    'name' => 'Anjali Patel',
                    'role' => 'Profile Specialist',
                    'description' => 'Helps members create compelling profiles that stand out and attract the right matches.',
                    'email' => 'anjali@happilyweds.com',
                    'image' => 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
                ],
                [
                    'name' => 'Amit Singh',
                    'role' => 'Safety Officer',
                    'description' => 'Ensures all interactions are safe, respectful, and adhere to community guidelines.',
                    'email' => 'amit@happilyweds.com',
                    'image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
                ]
            ]
        ];
        return view('pages.contact', $data);
    }

    /**
     * Handle contact form submission.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'wedding_date' => 'nullable|date|after:today',
            'inquiry_type' => 'required|string|in:planning,vendor,inspiration,venue,budget,other',
            'message' => 'required|string|min:10|max:5000',
            'newsletter' => 'nullable|boolean',
            'free_guide' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->route('contact.index')
                ->withErrors($validator)
                ->withInput();
        }

        // Store the contact message
        $contactMessage = ContactMessage::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'wedding_date' => $request->wedding_date,
            'inquiry_type' => $request->inquiry_type,
            'message' => $request->message,
            'subscribe_newsletter' => $request->has('newsletter'),
            'request_guide' => $request->has('free_guide'),
            'ip_address' => $request->ip(),
        ]);

        // Send email notification
        try {
            Mail::to(config('mail.admin_email', 'admin@happilyweds.com'))
                ->send(new ContactFormMail($contactMessage));
        } catch (\Exception $e) {
            \Log::error('Failed to send contact email: ' . $e->getMessage());
        }

        // Send free guide if requested
        if ($request->has('free_guide')) {
            // Add logic to send wedding planning guide
            \Log::info('Free wedding guide requested by: ' . $request->email);
        }

        // Subscribe to newsletter if requested
        if ($request->has('newsletter')) {
            // Add newsletter subscription logic
            \Log::info('Newsletter subscription requested by: ' . $request->email);
        }

        return redirect()->route('contact.index')
            ->with('success', 'Thank you for your message! We will get back to you within 24 hours.');
    }
}