<?php
namespace App\Http\Responses;
use Laravel\Fortify\Contracts\LoginResponse as ContractLoginResponse;

class LoginResponse implements ContractLoginResponse
{
    public function toResponse($request)
    {
        if(auth()->user()->role == 'admin'){
            return redirect()->intended(config('fortify.admin_home'));
        }
        return redirect()->intended(config('fortify.home'));
    }
}
