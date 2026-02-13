<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminAuthController extends Controller
{
    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        // Redirect if already authenticated
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $email = strtolower(trim($request->email));
        $password = $request->password;

        // Check for admin credentials (demo)
        if ($email === 'admin@gmail.com' && $password === 'admin12345') {
            // Find or create admin user
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => 'Admin',
                    'password' => Hash::make($password),
                    'email_verified_at' => now(),
                ]
            );

            // Log in the user
            Auth::login($user, true); // true = remember me

            return redirect()->route('admin.dashboard')
                ->with('success', 'Welcome back, Admin!');
        }

        // Try regular authentication
        $credentials = [
            'email' => $email,
            'password' => $password,
        ];

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        return view('admin-dashboard');
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'You have been logged out successfully.');
    }
}
