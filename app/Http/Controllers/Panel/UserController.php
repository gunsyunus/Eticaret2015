<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserProfileRequest;
use App\Models\UserLog;
use App\Models\User;
use Logging;

class UserController extends PanelController
{
    /**
     * System administrators list.
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $users = User::where('role', '=', 1)->orderBy('id_user', 'DESC')->paginate(25);
        return view('panel.module.user.index', compact('users'));
    }

    /**
     * New administrator creation form.
     *
     * @return \Illuminate\View\View
     */
    public function getNew()
    {
        return view('panel.module.user.new');
    }

    /**
     * Add administrator.
     *
     * @param  UserCreateRequest $request
     * @return Response
     */
    public function postAdd(UserCreateRequest $request)
    {
        $user = new User;
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->role = 1;
        $user->save();

        if ($user->save()) {
            Logging::message('Yeni yönetici ekledi ('.$user->email.')');
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Yönetici eklendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt eklerken hata oluştu !'));
        }
    }

    /**
     * Edit administrator information.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id)
    {
        $users = User::where('id_user', '=', $id)->where('role', '=', 1)->firstOrFail();
        return view('panel.module.user.edit', compact('users'));
    }

    /**
     * Administrator password change form.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getPassword($id)
    {
        $users = User::where('id_user', '=', $id)->where('role', '=', 1)->firstOrFail();
        return view('panel.module.user.password', compact('users'));
    }

    /**
     * Update manager information
     *
     * @param  UserUpdateRequest $request
     * @param  int               $id
     * @return Response
     */
    public function postSave(UserUpdateRequest $request, $id)
    {
        $user = User::where('id_user', '=', $id)->where('role', '=', 1)->firstOrFail();
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        $user->save();

        if ($user->save()) {
            Logging::message('Yönetici güncelledi ('.$user->email.')');
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Yönetici güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Update the password.
     *
     * @param  UserProfileRequest $request
     * @param  int                $id
     * @return Response
     */
    public function postPasswordsave(UserProfileRequest $request, $id)
    {
        $user = User::where('id_user', '=', $id)->where('role', '=', 1)->firstOrFail();
        $user->password = $request->input('password');
        $user->save();

        if ($user->save()) {
            Logging::message('Yönetici şifre güncelledi ('.$user->email.')');
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Yönetici şifresi güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Delete administrator.
     *
     * @param  int $id
     * @return Response
     */
    public function getDelete($id)
    {
        $user = User::where('id_user', '=', $id)->where('role', '=', 1)->firstOrFail();
        $user->delete();

        if (!$user->delete()) {
            Logging::message('Yönetici sildi ('.$user->email.')');
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Yönetici silindi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt silinirken hata oluştu !'));
        }
    }

    /**
     * List all logs of the manager whose ID is id_user.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getLogs($id)
    {
        $users = User::where('id_user', '=', $id)->where('role', '=', 1)->firstOrFail();
        $logs = UserLog::where('user_id', '=', $id)->orderBy('id_log', 'DESC')->paginate(100);
        return view('panel.module.user.log', compact('users', 'logs'));
    }
}
