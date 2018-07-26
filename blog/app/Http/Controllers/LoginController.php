<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Set Login Info. into session
     *
     * @return void
     */
    public function doLogin()
    {
        echo "<pre>"; print_r('doLogin'); echo "</pre>"; exit();
    }

    /**
     * Unset Session and redirect to login page
     *
     * @return void
     */
    // public function logout(Request $request)
    // {
    // 	$request->session()->forget('key');
    // 	return redirect()->route('login');
    // }
}
