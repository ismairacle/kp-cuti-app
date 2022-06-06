<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;


class VerifyUserController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('admin');
        }
        elseif (Auth::user()->hasRole('user')) {
            return redirect()->route('index');
        }
        elseif (Auth::user()->hasRole('approver')) {
            return redirect()->route('approver');
        }
        Auth::logout();
    }
}
