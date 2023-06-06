<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //Show Register Form
    public function create()
    {
        return view('users.register');
    }
}