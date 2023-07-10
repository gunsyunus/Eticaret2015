<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

/**
 * Administrator Panel Controller
 *
 * All admin pages are used.
 */
class PanelController extends Controller
{
    /**
     * Administrator checks session.
     */
    public function __construct()
    {
        $this->middleware('administrator', ['except' => [
            'index',
            'login'
        ]]);
    }
}
