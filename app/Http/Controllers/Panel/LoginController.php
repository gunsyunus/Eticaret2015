<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Http\Requests\UserLoginRequest;
use Auth;
use Logging;

class LoginController extends PanelController
{
    /**
     * Administrator login screen.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('panel.login');
    }

    /**
     * Check and redirect administrator login information.
     *
     * @param  UserLoginRequest $request
     * @return void
     */
    public function login(UserLoginRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt(array('email'=>$email,'password'=>$password,'role'=>1))) {
            Logging::message('Giriş Yaptı');
            return redirect('Pv3/Dashboard');
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Giriş bilgileriniz hatalı !'));
        }
    }

    /**
     * Administrator logout.
     *
     * @return Response
     */
    public function logout()
    {
        if (Auth::check()) {
            Logging::message('Çıkış Yaptı');
        }

        Auth::logout();
        
        return view('panel.login')->with('logout', 'success');
    }
}
