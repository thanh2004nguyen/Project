<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $array = ['bear', 'dog', 'rabbit'];
        $randomElement = Arr::random($array);
        // dd($randomElement);

        $user = User::create([
            'name' => $request->name,
            'birthday' => $request->date,
            'address' => $request->provinceName . ', ' . $request->dictrictName . ', ' . $request->warldName . ',' . $request->street,
            'shipping_address_street' => $request->street,
            'shipping_wardId' => $request->ward,
            'email' => $request->email,
            'shipping_dictrictId' => $request->district,
            'password' => Hash::make($request->password),
            'avatar' => $randomElement
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
