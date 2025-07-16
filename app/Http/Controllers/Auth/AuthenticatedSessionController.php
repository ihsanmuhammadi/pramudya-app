<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    // Hardcoded admin credentials
    private const ADMIN_EMAIL = 'admin@pramudyaputra.com';
    private const ADMIN_PASSWORD = 'jayasepanjanghayat947';

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Check if it's the hardcoded admin first
        if ($this->attemptAdminLogin($request)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard', absolute: false));
        }

        // If not admin, proceed with normal authentication
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Attempt to login with hardcoded admin credentials
     */
    private function attemptAdminLogin(Request $request): bool
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if ($email === self::ADMIN_EMAIL && $password === self::ADMIN_PASSWORD) {
            // Create or find admin user
            $adminUser = User::firstOrCreate(
                ['email' => self::ADMIN_EMAIL],
                [
                    'name' => 'Admin',
                    'email' => self::ADMIN_EMAIL,
                    'password' => Hash::make(self::ADMIN_PASSWORD),
                    'email_verified_at' => now(),
                    'is_admin' => true,
                ]
            );

            // Login the admin user
            Auth::login($adminUser);
            return true;
        }

        return false;
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
