<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\Token;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function show(Email $email)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function edit(Email $email)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Email $email)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
        //
    }

    public function registerConfirmation($token){
        $token = Token::where([['content',$token],['type', 'register_confirmation']])->first();
        if($token != null){
            if(Carbon::now()->gt($token->validity_period)){
                $title = 'Email Gagal Dikonfirmasi';
                $message = 'Email Sudah Tidak Berlaku lagi. ';
            }else{
                $user = User::where('uuid',$token->user_id)->first();
                $user->update([
                    'email_verified_at' => Carbon::now()
                ]);
                $title = 'Email Berhasil Dikonfirmasi';
                $message = 'Sekarang anda dapat login ke aplikasi kami';
            }
        }else{
            $title = 'Email Gagal Dikonfirmasi';
            $message = 'Token Tidak Ditemukan.';
        }
        return view('auth.email_response', ['title' => $title, 'message' => $message]);
    }
    public function resetPassword($token){
        $token = Token::where([['content',$token],['type', 'reset_password']])->first();
        if($token != null){
            if(Carbon::now()->gt($token->validity_period)){
                $title = 'Email Gagal Dikonfirmasi';
                $message = 'Email Sudah Tidak Berlaku lagi. ';
                return view('auth.email_response', ['title' => $title, 'message' => $message]);
            }else{
                $title = 'Email Berhasil Ditemukan';
                $message = 'Silahkan ubah password anda. ';
                return view('auth.reset_password', ['title' => $title, 'message' => $message]);
            }
        }else{
            $title = 'Email Gagal Dikonfirmasi';
            $message = 'Token Tidak Ditemukan.';
            return view('auth.email_response', ['title' => $title, 'message' => $message]);
        }
    }
    public function resetPassword(Request $request, $token){
        $token = Token::where([['content',$token],['type', 'reset_password']])->first();
        if($token != null){
            if(Carbon::now()->gt($token->validity_period)){
                $title = 'Email Gagal Dikonfirmasi';
                $message = 'Email Sudah Tidak Berlaku lagi. ';
                return view('auth.email_response', ['title' => $title, 'message' => $message]);
            }else{
                $title = 'Password Berhasil Diubah';
                $message = 'Silahkan login kembali. ';
                return view('auth.email_response', ['title' => $title, 'message' => $message]);
            }
        }else{
            $title = 'Email Tidak Bisa Digunakan';
            $message = 'Token Tidak Ditemukan.';
            return view('auth.email_response', ['title' => $title, 'message' => $message]);
        }
    }
}
