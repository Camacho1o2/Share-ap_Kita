<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Post;

class UserController extends Controller
{
    // Show the user profile page
    public function showProfile()
    {
        $user = Auth::user();

        $posts = Post::where('user_id', $user->id)->get();

        return view('content.profile', compact('user', 'posts'));
    }

    public function logout()
    {
        Auth::logout(); // Logs out the user
        return redirect('/login'); // Redirects the user to the login page or any other page
    }


    // Show the user edit profile form
    public function editProfile()
    {
        $user = Auth::user();
        return view('user.edit', compact('user'));
    }

    // Update user profile information
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'address' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'user_desc' => 'nullable|string',
            'kitchen_role' => 'nullable|string',
        ]);

        $user = Auth::user();
        $user->update($request->all());

        return redirect()->route('content.profile')->with('success', 'Profile updated successfully!');
    }

    // Show detailed user information
    public function showUserInfo(string $id)
    {
        $user = User::findOrFail($id);
        return view('user.showInfo', compact('user'));
    }

    // Show form to edit user information (name, address, date_of_birth)
    public function editUserInfo(string $id)
    {
        $user = User::findOrFail($id);
        return view('user.editInfo', compact('user'));
    }

    // Save updated user information
    public function updateUserInfo(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        // Validate the updated fields
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id], // Ensure the email is unique but allow the current user's email
            'address' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'user_desc' => ['nullable', 'string', 'max:500'],  // Optional field for user description
            'kitchen_role' => ['nullable', 'string', 'max:100'],  // Optional field for kitchen role
        ]);

        // Update the user's information
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'date_of_birth' => $validated['date_of_birth'],
             'user_desc' => $validated['user_desc'] ?? $user->user_desc,  // Keep old value if not provided
            'kitchen_role' => $validated['kitchen_role'] ?? $user->kitchen_role,  // Keep old value if not provided
        ]);

        return redirect()->route('user.showInfo', ['id' => $id])->with('success', 'Information updated successfully.');
    }

    // Show the change password form
    public function showChangePasswordForm()
    {
        return view('user.change_password');
    }

    // Update the user's password
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Check if the current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Password changed successfully!');
    }

    // Show the user delete account form
    public function showDeleteAccountForm()
    {
        return view('user.delete_account');
    }

    // Delete user account
    public function deleteAccount(Request $request)
    {
        $user = Auth::user();
        $user->delete();

        // Log the user out after account deletion
        Auth::logout();

        return redirect()->route('home')->with('success', 'Your account has been deleted successfully.');
    }
}

