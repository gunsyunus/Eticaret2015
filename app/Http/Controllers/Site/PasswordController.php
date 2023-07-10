<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\SiteController;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Mail\Message;
use App\Models\Setting;

class PasswordController extends SiteController
{
    use ResetsPasswords;

    /**
     * @var string
     */
    protected $subject = "Şifre Sıfırlama Talebi";

    /**
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Reset the given user's password.
     *
     * ATTENTION: "bcrypt" has been removed because it conflicts with "User.php"
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $user->forceFill([
            'password' => $password,
            'remember_token' => Str::random(60),
        ])->save();

        Auth::guard($this->getGuard())->login($user);
    }

    /**
     * Customer reset password validation messages
     *
     * @return array
     */
    protected function getResetValidationMessages()
    {
        return [
            'email.required' => 'E-Posta alanı zorunludur.',
            'password.required' => '"Şifre" alanı zorunludur ve en az "6" karakter olmalıdır.',
            'password.min' => '"Şifre" alanı zorunludur ve en az "6" karakter olmalıdır.'
        ];
    }

    /**
     * Get the Closure which is used to build the password reset email message.
     *
     * @return \Closure
     */
    protected function resetEmailBuilder()
    {
        return function (Message $message) {
            $mail = Setting::select('email_info', 'email_info_name')->find(1);
            $message->subject($this->getEmailSubject());
            $message->from($mail->email_info, $mail->email_info_name);
        };
    }
}
