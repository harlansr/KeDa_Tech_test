<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User_type;

class AuthController extends Controller
{
    public function getLogin(){
        return view('login');
    }

    public function postLogin(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if(!auth()->attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->back();
        }

        $my_id = \Auth::user()->user_type_id;
        $get_data = User_type::where('id', '=', $my_id)
                ->get();

        session(['user_type' => $get_data[0]->name]);

        return redirect()->route('home');
    }

    public function getRegister(){
        return view('register');
    }

    public function postRegister(Request $request){
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);
        $user = User::create([
            'user_type_id' => 1,
            'email' => $request -> email,
            'password' => bcrypt($request->password),
            
        ]);
        
        // auth()->loginUsingId($user->id);

        return redirect()->route('login');
        
    }



    public function logout(){
        auth()->logout();
        return redirect() -> route('login');
    }
}
