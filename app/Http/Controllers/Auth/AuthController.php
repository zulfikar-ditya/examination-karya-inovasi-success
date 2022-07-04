<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function view_login()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|exists:users,email|email|string|max:255',
            'password' => 'required|string|max:255'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->back();
        }

        return redirect()->back()->with($this->get_set_message_crud(false, 'login', 'Incorrect password.'));
    }

    public function view_register()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $model = new User();
        $this->validate($request, $model->rules());
        $model->loadModel($request->all());

        try {
            $model->save();
        } catch (\Throwable $th) {
            return redirect()->back()->with($this->get_set_message_crud(false, 'register', 'Failed registering your data. '.$th->getMessage()));
        }

        if (Auth::loginUsingId($model->id)) {
            return redirect()->back();
        }

        return redirect()->back()->with($this->get_set_message_crud(false, "Failed Register"));
    }
}
