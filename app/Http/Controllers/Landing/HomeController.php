<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('client.index');
        } else {
            return redirect()->route('login');
        }
    }

    public function home()
    {
        return redirect()->route('index');
    }
}
