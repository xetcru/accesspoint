<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    // === Методы для веб-интерфейса ===

    // Показать форму регистрации
    public function showRegisterForm()
    {
        return view('register');
    }

    // Обработать регистрацию (веб)
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    // Показать форму авторизации
    public function showLoginForm()
    {
        return view('login');
    }

    // Авторизация пользователя (веб)
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Получение текущего пользователя (для API)
    /*public function user()
    {
        return response()->json(auth('api')->user());
    }*/

    // Выход пользователя (веб)
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    // Отображение домашней страницы
    public function home()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return view('home', compact('user')); // Передаем пользователя в шаблон
        }

        return redirect()->route('login'); // Если не авторизован, отправляем на логин
    }

    // === Методы для API ===

    // Регистрация через API
    public function apiRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
            ],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(['token' => $token], 201);
    }

    // Авторизация через API
    public function apiLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return response()->json(['token' => $token]);
    }

    // Получение текущего пользователя (API)
    public function apiUser()
    {
        $user = auth('api')->user();

        if (!$user) {
            return response()->json(['error' => 'Not authenticated'], 401);
        }

        return response()->json($user);
    }

    // Выход через API
    public function apiLogout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
