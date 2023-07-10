<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Http\Requests\UserProfileRequest;
use App\Models\User;
use Auth;
use Logging;

class ProfileController extends PanelController
{
    /**
     * Administrator password change form.
     *
     * @return\Illuminate\View\View
     */
    public function getIndex()
    {
        $id = Auth::user()->id_user;
        $users = User::where('id_user', '=', $id)->where('role', '=', 1)->firstOrFail();
        return view('panel.module.profile.password', compact('users'));
    }

    /**
     * The administrator updates his password.
     *
     * @param  UserProfileRequest $request
     * @return Response
     */
    public function postSave(UserProfileRequest $request)
    {
        $id = Auth::user()->id_user;
        $user = User::where('id_user', '=', $id)->where('role', '=', 1)->firstOrFail();
        $user->password = $request->input('password');
        $user->save();

        if ($user->save()) {
            Logging::message('Şifre değiştirdi');
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Profil güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }
}
