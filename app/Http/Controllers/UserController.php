<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //Show Register Form
    public function create()
    {
        return view('users.register');
    }

    //Create New User
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        //Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        //Create User
        $user = User::create($formFields);

        //Login with auth
        auth()->login($user);

        //Redirect
        //TODO: Display Flash Message
        return redirect('/')->with('message', 'Registration successful! You\'re now logged in.');

    }

    //Log User Out
    public function logout(Request $request)
    {
        auth()->logout();
        //Invalidate User Session
        $request->session()->invalidate();
        //Regenerate csrf Token
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');
    }

    //Show Login Form
    public function login()
    {
        return view('users.login');
    }

    //Authenticate User
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields)) {
            //Generate Session Id
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in!');
        }
        //If Login Fails
        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    //Show Manage Profile View
    public function showProfile()
    {
        $user = Auth::user();
        return view('users.profile', compact('user'));
    }

    //Update Profile
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        //Update name
        $user->name = $request->input('name');

        //Update email
        $user->email = $request->input('email');

        // Save the updated fields
        $user->save();

        return redirect()->back()->with('message', 'Profile updated successfully!');
    }

    //Show Change Password Form
    public function showChangePasswordForm()
    {
        return view('users.change-password');
    }

    //Update Password
    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'current_password' => [
                'required',
                function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        $fail('The current password is incorrect.');
                    }
                }
            ],
            'new_password' => ['required', 'confirmed', 'min:6']
        ], [
            'new_password.confirmed' => 'The new password and confirmation do not match.'
        ]);

        $user->password = bcrypt($request->input('new_password'));
        $user->save();

        return redirect()->back()->with('message', 'Password updated successfully!');
    }

    public function favorites()
    {
        $user = auth()->user();
        $recipes = $user->favoriteRecipes()->get(); // or $user->favoriteRecipes()->paginate(10);

        // dd($recipes);

        return view('ingredients.index', ['recipes' => $recipes]);
    }



}