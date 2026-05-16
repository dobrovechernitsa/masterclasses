<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Введите email',
            'email.email' => 'Введите корректный email',
            'password.required' => 'Введите пароль',
            'password.min' => 'Пароль должен содержать минимум 6 символов',
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();

            if (auth()->user()->isInstructor()) {
                return redirect()->route('instructor.cabinet');
            }

            return redirect()->intended('/');
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'Неверный email или пароль.',
            ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'full_name' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    $words = explode(' ', trim(preg_replace('/\s+/', ' ', $value)));
                    if (count($words) < 2) {
                        $fail('Введите Фамилию и Имя (минимум 2 слова)');
                    }
                },
            ],
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => [
                'required',
                'string',
                'regex:/^(\+7|8)?[\s\-]?\(?[0-9]{3}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/',
            ],
        ], [
            'full_name.required' => 'Введите ФИО',
            'full_name.max' => 'Слишком длинное ФИО',
            'email.required' => 'Введите email',
            'email.email' => 'Введите корректный email адрес',
            'email.unique' => 'Пользователь с таким email уже существует',
            'password.required' => 'Введите пароль',
            'password.min' => 'Пароль должен содержать минимум 6 символов',
            'password.confirmed' => 'Пароли не совпадают',
            'phone.required' => 'Введите номер телефона',
            'phone.regex' => 'Введите корректный номер телефона',
        ]);

        $user = User::create([
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'],
            'role' => 'visitor',
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Регистрация успешно завершена!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
