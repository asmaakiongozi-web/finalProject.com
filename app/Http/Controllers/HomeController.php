<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function adminDashboard()
    {
        return view('admin.adminDashboard');
    }

    public function manageUsers()
    {
        $users = User::latest()->paginate(15);

        return view('admin.users', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users-create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'usertype' => 'required|string|in:user,professional,admin',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'usertype' => $request->input('usertype'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('admin.users')->with('success', 'New user added successfully.');
    }

    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'usertype' => 'required|string|in:user,professional,admin',
        ]);

        if ($user->id === Auth::id() && $request->input('usertype') !== 'admin') {
            return redirect()->back()->with('error', 'You cannot remove your own admin access from this page.');
        }

        $user->usertype = $request->input('usertype');
        $user->save();

        return redirect()->back()->with('success', 'User role updated successfully!');
    }

    public function destroyUser(User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'You cannot delete your own account from the admin panel.');
        }

        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}
