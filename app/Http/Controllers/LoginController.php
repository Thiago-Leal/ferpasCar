<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Config;
use DB;

class LoginController extends Controller
{
    public function gate()
    {
        $register = false;

        if(User::all()->count() > 0) {
            return view('login', compact('register'));
        }

        $register = true;
        return view('login', compact('register'));
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            //1 = wash | 2 = Oil
            session([
                'CONNECTION' => ($request['empresa'] == 1 ? 'mysql' : 'mysql_ferpasOil'), 
                'EMPRESA_DESCRICAO' => $request['empresa'] == 1 ? 'Lava-Car' : 'Troca de Óleo',
            ]);
            
            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'form' => 'email ou senha inválido.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed'],
        ]);

        $request['password'] = Hash::make($request['password']);

        User::create($request->all());

        $register = false;
        return view('login', compact('register'));
    }
}