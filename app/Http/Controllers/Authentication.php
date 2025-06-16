<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\InvoiceDetail;

class Authentication extends Controller
{
    public function home()
    {
        $user = Auth::user();

        $invoiceDetails = InvoiceDetail::with('book')
            ->whereHas('invoiceHeader', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->latest()
            ->get();

        return view('home', compact('invoiceDetails'));
    }
    function login(){
        return view('auth.login');
    }
    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect('/admin/dashboard')->with('success', 'Welcome back, Admin!');
            } else {
                return redirect('/home')->with('success', 'Login successful!');
            }
        }

        return back()->withErrors([
            'username' => 'Invalid username or password.',
        ]);
    }

    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logged out successfully!');
    }
    function register(){
        return view('auth.register');
    }
    public function registerPost(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role' => 'user', // default role
        ]);

        return redirect('/login')->with('success', 'Registration successful! Please login.');
    }

}
