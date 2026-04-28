<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $AuthService;
    public function __construct(AuthService $AuthService)
    {
        $this->AuthService = $AuthService;
    }

    public function showRegister()
    {
        return view('auth.register');
    }
    public function register(RegisterRequest $request)
    {
        $user = $this->AuthService->register($request->validated());
        Auth::login($user);
        return redirect('/');
    }
    public function showLogin()
    {
        return view('auth.login');
    }
    public function login(LoginRequest $request)
    {
        if ($user = $this->AuthService->login($request->validated())) {

            $request->session()->regenerate();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect('/');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
