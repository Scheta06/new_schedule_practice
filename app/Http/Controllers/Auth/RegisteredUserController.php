<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'surname'    => 'required|string|max:255',
            'name'       => 'required|string|max:255',
            'patronymic' => 'required|string|max:255',
            'email'      => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password'   => ['required'],
        ]);

        $user = User::create([
            'surname'    => $request->surname,
            'name'       => $request->name,
            'patronymic' => $request->patronymic,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('login');
    }
}
