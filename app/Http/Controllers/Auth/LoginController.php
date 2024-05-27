<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){ 
        return view("auth.login");
    }

    public function login(LoginRequest $request){
        $email = $request->email;
        $password = $request->password;
        $remember = $request->remember;
        
        !is_null($request->remember) ? $remember= true : $remember=false;

        $user = User::where("email", $email)->first();

        if($user && Hash::check($password,$user->password)){
            Auth::login($user, $remember);
            // Auth::loginUsingId($user->id);
            return redirect()-> route("admin.index");
        }else{  
            return redirect() 
            ->route("login")
            ->withErrors(["email"=> "Verdiğiniz bilgiler hatalı !"])
            ->onlyInput("email","remember");
        }
    }

    public function logout2(LoginRequest $request){
        $email = $request->email;
        $password = $request->password;
        $remember = $request->remember;
        
        !is_null($request->remember) ? $remember= true : $remember=false;

        if(Auth::attempt(["email"=> $email,"password"=> $password,],$remember)){
            return redirect()->route("admin.index");    
        }else{
            return redirect()
            ->route("login");
        }
    }

    public function logout3(LoginRequest $request){
        $email = $request->email;
        $password = $request->password;
        $remember = $request->remember;
        
        !is_null($request->remember) ? $remember= true : $remember=false;

        if(Auth::attempt(["email"=> $email,"password"=> $password,"status"=>1],$remember)){
            return redirect()->route("admin.index");    
        }else{
            return redirect()
            ->route("login");
        }
    }

    public function logout(Request $request){
        if(auth()->check())
        {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()
                ->route("login")
                ->withErrors(["email"=>"Verdiğiniz bilgiler hatalı !"])
                ->onlyInput("email","remember");
        }

    }
}
