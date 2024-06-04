<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        Log::info('Validating registration data:', $data);
        
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                function($attribute, $value, $fail) use ($data) {
                    if ($data['role'] === 'admin' && !str_contains($value, '@staff')) {
                        $fail('Email untuk admin harus mengandung @staff.');
                    }
                    if ($data['role'] !== 'admin' && !str_contains($value, '@student')) {
                        $fail('Email untuk non-admin harus mengandung @student.');
                    }
                },
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:guest,admin'],
            'secret_code' => [
                'required_if:role,admin',
                function($attribute, $value, $fail) {
                    if ($value !== 'RAHASIA2023' && request()->role === 'admin') {
                        $fail('Kode rahasia untuk admin tidak valid.');
                    }
                },
            ],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        Log::info('Creating new user:', $data);
        
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|null
     */
    public function register(Request $request)
    {
        Log::info('Register attempt:', $request->all());
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        Log::info('User registered successfully:', ['user' => $user->email]);
        
        return redirect('/login')->with('status', 'Registration successful. Please login to continue.');
    }
}
