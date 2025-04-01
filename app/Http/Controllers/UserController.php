<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\UserEvent;

class UserController extends Controller
{

    public function logout(Request $request) {
        auth()->logout();
        return redirect('/');
    }

    public function login(Request $request) {
        $incomingFields = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required'
        ]);

        if(auth()->attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();
        }

        return redirect('/');
    }

    public function register(Request $request) {
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:10'],
            'email' => ['required', 'min:3', 'max:20'],
            'password' => ['required', 'min:3', 'max:10']
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        auth()->login($user);

        return redirect('/');
    }

    public function change_password(Request $request) {

        $incomingFields = $request->validate([
            'new_password' => ['required', 'min:3', 'max:10']
        ]);
       
        User::where('id',  auth()->id())->update(['password'=> bcrypt($incomingFields['new_password'])]);
        auth()->logout();

        return redirect('/');
    }
}
