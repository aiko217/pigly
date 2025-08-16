<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
    $validated = $request->validated();

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
    ]);

    Auth::login($user);
    return redirect()->route('initial_weight');
    }

    public function getLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin');
        }

    }
    public function initial_weight()
    {

        return view('auth.initial_weight', );
    }

    public function storeInitialWeight(InitialWeightRequest $request)
    {
        $validated = $request->validated();


        $request->session()->put('initial_weight', $validated);

        return redirect()->route('complete_registration');
    }

    public function completeRegistration(Request $request)
    {
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    $initialWeight = $request->session()->get('initial_weight');

    if ($initialWeight) {
        WeightLog::create([
            'user_id' => $user->id,
            'current_weight' => $initialWeight['current_weight'],
            'date' => now(),
        ]);

        WeightTarget::create([
            'user_id' => $user->id,
            'target_weight' => $initialWeight['target_weight'],
        ]);

        $request->session()->forget('initial_weight');
    }

    Auth::login($user); 

    return redirect()->route('admin')->with('success', '会員登録完了！体重データも保存されました。');
    }
}
