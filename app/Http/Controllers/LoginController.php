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
            return redirect('/');
        } else {
            return Redirect::back()->with(['errorMsg' => 'Unsuccessful login!']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
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

        return redirect('/')->with('userCreated', 'User has been successfully created');
    }
}
