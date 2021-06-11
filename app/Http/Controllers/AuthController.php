<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use App\Models\Token;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailRegisterConfirmation;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginView(){
        return view('auth.login');
    }
    public function login(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password' => ['required','string'],
        ]);
        $user = User::where('email',$request->email)->first();
        if($user){
            if(Hash::check($request->password,$user->password)){
                if($user->email_verified_at != null){
                    
                }
                return redirect()->back()->withErrors(['email' => 'Email belum dikonfirmasi.']);
            }
            return redirect()->back()->withErrors(['password' => 'Password Salah.']);
        }
        return redirect()->back()->withErrors(['email' => 'Email belum terdaftar pada sistem.']);
    }
    public function registerView(){
        return view('auth.register');
    }
    public function register(Request $request){
        $this->validate($request,[
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,',
            'password' => ['required','string','confirmed', Password::min(8)->mixedCase()->numbers()->uncompromised()],
        ]);
        $user = User::create($request->only('name','email','password'));
        $token = Token::create([
            'user_id' => $user->uuid,
            'type' => 'register_confirmation',
            'content' => Str::random(100),
            'validity_period' => Carbon::now()->addDays(1)
        ]);
        $email = Mail::to($user->email)->send(new MailRegisterConfirmation($user));
        // return $email;
        $validity_period = Carbon::parse($token->validity_period)->locale('id');
        $validity_period->settings(['formatFunction' => 'translatedFormat']);
        return view('auth.register-success',['data' => $validity_period->format('l, j F Y H:i:s')]);
    }
}