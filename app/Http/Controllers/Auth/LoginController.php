<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /*
    |--------------------------------------------------------------------------
    | AFTER LOGIN SUCCESS
    |--------------------------------------------------------------------------
    */
    protected function authenticated(Request $request, $user)
    {
        // Update login info
        $user->updateLastLogin($request->ip());

        // If Admin Role → Require OTP
        // if ($user->roles()->exists()) {

        //     Auth::logout(); // temporary logout

        //     $otp = rand(100000, 999999);

        //     $this->storeOtp($user->email, $otp);

        //     // Email HTML
        //     $html = "
        //         <h2>Admin Login Verification</h2>
        //         <p>Your OTP is:</p>
        //         <h1 style='color:#4CAF50;'>$otp</h1>
        //         <p>This OTP will expire in 5 minutes.</p>
        //     ";

        //     Mail::send([], [], function ($mail) use ($user, $html) {
        //         $mail->to($user->email)
        //             ->subject('Admin Login OTP')
        //             ->html($html);
        //     });

        //     Session::put('otp_user_email', $user->email);

        //     return redirect()->route('otp.form');
        // }
    }

    /*
    |--------------------------------------------------------------------------
    | OTP FORM
    |--------------------------------------------------------------------------
    */
    public function showOtpForm()
    {
        if (!session('otp_user_email')) {
            return redirect('/login');
        }

        return view('auth.admin-otp');
    }

    /*
    |--------------------------------------------------------------------------
    | VERIFY OTP
    |--------------------------------------------------------------------------
    */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6'
        ]);
    
        $email = session('otp_user_email');
    
        if (!$email) {
            return redirect('/login');
        }
    
        if ($this->checkOtp($email, $request->otp)) {
    
            $user = User::where('email', $email)->first();
    
            Auth::login($user);
    
            session()->forget('otp_user_email');
    
            $this->deleteOtp($email);
    
            return redirect()->intended($this->redirectTo());
        }
    
        return back()->with('error', 'Invalid or Expired OTP');
    }

    /*
    |--------------------------------------------------------------------------
    | STORE OTP (FILE BASED)
    |--------------------------------------------------------------------------
    */
    private function storeOtp($email, $otp)
    {
        $path = storage_path('admin_otp.json');

        $data = file_exists($path)
            ? json_decode(file_get_contents($path), true)
            : [];

        $data[$email] = [
            'otp' => Hash::make($otp),
            'expires_at' => now()->addMinutes(5)->timestamp
        ];

        file_put_contents($path, json_encode($data));
    }

    /*
    |--------------------------------------------------------------------------
    | CHECK OTP
    |--------------------------------------------------------------------------
    */
    private function checkOtp($email, $otp)
    {
        $path = storage_path('admin_otp.json');

        if (!file_exists($path)) return false;

        $data = json_decode(file_get_contents($path), true);

        if (!isset($data[$email])) return false;

        if (now()->timestamp > $data[$email]['expires_at']) return false;

        if (!Hash::check($otp, $data[$email]['otp'])) return false;

        return true;
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE OTP AFTER SUCCESS
    |--------------------------------------------------------------------------
    */
    private function deleteOtp($email)
    {
        $path = storage_path('admin_otp.json');

        if (!file_exists($path)) return;

        $data = json_decode(file_get_contents($path), true);

        unset($data[$email]);

        file_put_contents($path, json_encode($data));
    }
    
protected function redirectTo()
{
    $user = Auth::user();

    // Check for ANY administrative role (Admin, Super Admin, Developer, Operator)
    // Or check the custom database column 'role'
    if (
        $user->isAdmin() || 
        $user->hasAnyRole(['Admin', 'Super Admin', 'Developer', 'Operator']) ||
        in_array($user->role, ['admin', 'developer', 'operator'])
    ) {
        return '/admin/dashboard';
    }

    return '/dashboard';
}
}