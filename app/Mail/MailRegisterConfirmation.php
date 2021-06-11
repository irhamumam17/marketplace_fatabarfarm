<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Token;


class MailRegisterConfirmation extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $token = Token::where([['user_id','=',$this->user->uuid],['type','=','register_confirmation']])->first();
        return $this->view('emails.register-confirmation')->subject('Fatabar Farm - Register Confirmation')
                        ->with('token',$token->content);
    }
}
