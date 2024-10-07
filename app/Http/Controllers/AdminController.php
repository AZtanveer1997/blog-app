<?php

namespace App\Http\Controllers;

use App\Models\User; // Import the User model
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Display a list of users with their associated posts
    public function index()
    {
        $users = User::with('posts')->get(); // Retrieve users with their posts
        return view('admin.index', compact('users')); // Pass users to the admin index view
    }

    // Delete a user and their associated posts
    public function destroy($id)
    {
        $user = User::findOrFail($id); // Find user by ID or fail if not found
        $user->posts()->delete(); // Delete all posts associated with the user
        $user->delete(); // Delete the user

        return redirect()->route('admin.index')->with('success', 'User and their posts deleted.'); // Redirect back with success message
    }
}
