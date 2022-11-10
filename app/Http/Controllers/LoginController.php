<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('forum.index');
        } else {
            return Redirect::back()->with(['alert_message' => 'Unsuccessful login!']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('forum.index');
    }

    public function createUser()
    {
        return view('users.create');
    }

    public function submitUser(User $user)
    {
        $name = request('name');
        $email = request('email');
        $password = Hash::make(request('password'));
        $isAdmin = request('isAdmin');

        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        $user->is_admin = $isAdmin;

        $user->save();

        return redirect()->route('forum.index')->with('success', 'User has been successfully created');
    }
}
