<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function edit()
    {
	    $user = Auth::user();

	    return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
	    $request->validate([
            'password' => ['required', 'confirmed'],
        ]);

        $user = user::find($id);
        $user->password = Hash::make($request['password']);
	    $user->update();

	    session()->flash('success', 'Senha atualizada com sucesso.');

	    return view('user.edit', compact('user'));
    }

}
