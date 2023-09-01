<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of all users.
     */
    public function index()
    {
        // Check if the authenticated user is user ID '1'
        if (Auth::user()->id === 1) {
            $users = User::all(); // Get all users from the database
            return view('backend.user.user_list', [
                'title' => 'User List',
                'users' => $users,
            ]);
        } else {
            return redirect()->route('home'); // Redirect other users to the homepage
        }
    }

    public function update(Request $request, $id)
    {
        // Check if the authenticated user is user ID '1'
        if (Auth::user()->id === 1) {
            $user = User::findOrFail($id);

            $request->validate([
                'username' => 'required|string|max:255|unique:users,username,' . $id,
                'email' => 'required|email|max:255|unique:users,email,' . $id,
            ]);

            $user->update([
                'username' => $request->username,
                'email' => $request->email,
            ]);

            return redirect()->route('user.index')->with('success', "User information updated successfully.");
        }

        return redirect()->route('home'); // Redirect other users to the homepage
    }



    public function destroy($id)
{
    // Check if the authenticated user is user ID '1'
    if (Auth::user()->id === 1) {
        User::destroy($id); // Delete the user
    }

    return redirect()->route('user')->with('success', "User berhasil di hapus"); // Redirect back to the user list
}


}