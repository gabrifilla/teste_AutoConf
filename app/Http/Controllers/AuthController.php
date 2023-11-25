<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('/auth/login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Busca no banco o usuário com base no e-mail enviado
        $user = User::where('email', $request->email)->first();
        
        // Verifica se usuário existe, e se a senha está correspondendo
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            // Login autenticado, sessão criada e então redireciona para página de usuários
            return redirect()->intended('/veiculos');
        } else {
            return back()->withInput()->withErrors(['email' => 'E-mail ou senha inválidos']);
        }
    }
}
