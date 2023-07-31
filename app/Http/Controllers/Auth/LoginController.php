<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }
    public function login(LoginRequest $request)
    {
 
        $credentials = $request->getCredentials();
        if (auth()->attempt($credentials)) {
            $admin = Auth::getProvider()->retrieveByCredentials($credentials);
            Auth::login($admin);
            return $this->authenticated($request, $admin);
        }
        return back()->withErrors([
            'email' => __('site.The_provided_credentials_do_not_match_our_records'),
        ])->withInput();
    }

    protected function authenticated(Request $request, $admin)
    {
        return redirect()->route('dashboard.index');
    }
}
