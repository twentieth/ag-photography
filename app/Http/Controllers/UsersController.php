<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests;
use App\User;

class UsersController extends Controller
{

	public function index(Request $request)
    {
    	return view('test.users');
    }

    public function authentication(Request $request)
    {
    	$email = $request->email;
    	$password = Hash::make($request->password);

    	$user = User::where('email', $email)->first();

    	//if(Auth::login($user))

    	if(Auth::attempt(['email' => $email, 'password' => $password]))
    	{
    		return redirect()->route('authentication');
    	}
    	else
    	{
    		return redirect()->route('index');
    	}

    	return view('test.authentication', ['email' => $email, 'password' => $password]);
    }
    
}
