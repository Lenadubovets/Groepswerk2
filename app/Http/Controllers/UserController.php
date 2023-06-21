<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Recipe;
use Illuminate\Http\Request;
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

    public function showProfile()
    {
        $user = Auth::user();
        return view('users.profile', compact('user'));
    }

    public function favorites()
    {
        $user = auth()->user();
        $recipes = $user->favoriteRecipes()->get(); // or $user->favoriteRecipes()->paginate(10);

        // dd($recipes);

        return view('ingredients.index', ['recipes' => $recipes]);
    }



}