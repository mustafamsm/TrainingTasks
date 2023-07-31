<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $requset)
    {
        $requset->validated();
          
        $admin = Admin::create($requset->all());
        auth()->login($admin);
        return redirect()->route('dashboard.index');
    }
}
