<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $identifierKey = strpos($request->identifier, '@') ? 'email' : 'nim';

        $user = User::create([
            'name' => $request->name,
            "$identifierKey" => $request->identifier,
            'password' => Hash::make($request->password)
        ]);

        if ($identifierKey == 'email') $user->assignRole('systemAdmin');
        else $user->assignRole('user');

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('home.index');
    }
}
