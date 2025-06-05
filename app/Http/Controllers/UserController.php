<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   
public function index()
{
    $users = User::whereNull('deleted_at')->get();
    return view('users.index', compact('users'));
}

public function create()
{
    return view('users.create');
}

public function store(Request $request)
{
    // Validate the incoming request data, including the password
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email',  // Ensuring email uniqueness
        'mobile' => 'required|string|max:15|unique:users,mobile',  // Ensuring mobile uniqueness
        'password' => 'required|string|min:8|confirmed',  // Added password validation
    ]);

    // Hash the password before saving it
    $validatedData['password'] = Hash::make($validatedData['password']);

    // Create the user with the validated data
    User::create($validatedData);

    // Redirect with success message
    return redirect()->route('users.index')->with('success', 'User added successfully');
}

public function show(User $user)
{
    return view('users.show', compact('user'));
}

public function edit(User $user)
{
    return view('users.edit', compact('user'));
}

public function update(Request $request, User $user)
{
    $user->update($request->all());
    return redirect()->route('users.index')->with('success', 'User updated successfully');
}

public function destroy(User $user)
{
    $user->delete();
    return redirect()->route('users.index')->with('success', 'User deleted successfully');
}
}