<?php

namespace App\Http\Controllers\Auth;

use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use \Illuminate\Http\Response;

class AuthController extends Controller
{
    use RedirectsUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function change()
    {
        return view('auth.change-password');
    }

    public function reset(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        if (!Hash::check($request['old_password'], Auth::user()->getAuthPassword()))
            return redirect()->route('pass-change')->withErrors([
                'old_password' => 'Aktuálne heslo nie je správne.'
            ]);

        if (Hash::check($request['password'], Auth::user()->getAuthPassword()))
            return redirect()->route('pass-change')->withErrors([
                'password' => 'Staré a nové heslo sa nesmie zhodovať.'
            ]);

        $response = $this->resetPassword(Auth::user(), $request['password']);

        return $response
            ? $this->sendResetResponse($request, $response)
            : $this->sendResetFailedResponse($request, $response);
    }

    protected function resetPassword(User $user, $password)
    {
        $user->password = Hash::make($password);
        $user->save();
        $this->guard()->login($user);
        return 1;
    }

    protected function sendResetResponse(Request $request, $response)
    {
        return redirect($this->redirectPath())
            ->with('success', ['Heslo bolo úspešne zmenené.']);
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
        return redirect()->route('pass-change')
            ->withErrors(['password' => trans($response)]);
    }

    protected function rules()
    {
        return [
            'password' => 'required|confirmed|min:8',
        ];
    }

    protected function validationErrorMessages()
    {
        return [
            'password.required' => 'Nebolo zadané heslo',
            'password.confirmed' => 'Heslá sa nezhodujú',
            'password.min' => 'Príliš krátke heslo',
        ];
    }

    protected function guard()
    {
        return Auth::guard();
    }
}

