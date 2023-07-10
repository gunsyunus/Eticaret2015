<?php

namespace App\Helpers;

use App\Models\UserLog;
use Auth;

class Logging
{
    /**
     * User Logging Helper
     *
     * @param  string $process_text
     * @return void
     */
    public static function message($process_text)
    {
        $log = new UserLog;
        $log->process_text = $process_text;
        $log->ip = $_SERVER['REMOTE_ADDR'];
        $log->user_email = Auth::user()->email;
        $log->user_id = Auth::user()->id_user;
        $log->process_at = date('Y-m-d H:i:s');
        $log->save();
    }
}
