<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function __invoke()
    {
        if(user()->isRegister()) {
            return redirect()->route('students');
        }
        return view('dashboard');
    }
}
