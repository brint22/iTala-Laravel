<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show the user creation form
    public function create()
    {
        return view('users.create'); // Make sure this Blade file exists
    }

    // Handle form submission to store a new user
  public function store(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'last_name' => 'required|string|max:255',
        'name_extension' => 'nullable|string|max:10',
        'birthdate' => 'required|date',
        'gender' => 'required|string',
        'contact_number' => 'required|string|max:20',
        'license_number' => 'nullable|string|max:50',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
        'role' => 'required|string|in:admin,Registered Psychometrician',
    ]);

    // Combine full name
    $fullName = trim($request->first_name . ' ' . ($request->middle_name ? $request->middle_name . ' ' : '') . $request->last_name);

    User::create([
        'first_name' => $request->first_name,
        'middle_name' => $request->middle_name,
        'last_name' => $request->last_name,
        'name_extension' => $request->name_extension,
        'birthdate' => $request->birthdate,
        'gender' => $request->gender,
        'contact_number' => $request->contact_number,
        'license_number' => $request->license_number,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'name' => $fullName, // ← added this line
    ]);

    return redirect()->route('dashboard')->with('success', 'User created successfully.');
}
}
