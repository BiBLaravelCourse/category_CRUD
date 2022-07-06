<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $user = User::where('email',$request->email)->first();

        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return redirect(route('login.create'))
            ->withErrors($validator)
            ->withInput();
        }        
    
        if(! $user)
        {
            throw ValidationException::withMessages([
                'email' => 'This email is not register',
            ]);
        }
        
        $credential = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(! Auth::attempt($credential)){
            throw ValidationException::withMessages([
                'password' => 'Password is wrong',
            ]);
        }

        return redirect(route('posts.index'));

        //email + password -> verify
        //user info -> session
    }

    public function destroy()
    {
        Auth::logout();

        return redirect(route('home'));
    }
}

